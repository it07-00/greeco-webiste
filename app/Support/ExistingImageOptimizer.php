<?php

namespace App\Support;

use App\Models\Banner;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class ExistingImageOptimizer
{
    private const MANIFEST_PATH = 'image-optimization-manifest.json';

    private const DIRECT_IMAGE_FIELDS = [
        [Banner::class, 'image', 3840, 2160, 84],
        [Post::class, 'thumbnail', 2560, 1440, 82],
        [Post::class, 'og_image', 1600, 900, 82],
        [Page::class, 'thumbnail', 2560, 1440, 82],
        [Page::class, 'og_image', 1600, 900, 82],
        [Service::class, 'thumbnail', 2560, 1440, 82],
        [Service::class, 'og_image', 1600, 900, 82],
        [Project::class, 'thumbnail', 2560, 1440, 82],
        [Project::class, 'og_image', 1600, 900, 82],
        [Partner::class, 'logo', 1600, 1600, 82],
    ];

    private const RICH_CONTENT_FIELDS = [
        [Post::class, 'content'],
        [Page::class, 'content'],
        [Service::class, 'content'],
        [Project::class, 'content'],
    ];

    public function run(
        bool $dryRun = false,
        bool $deleteOriginals = false,
        ?int $quality = null,
        int $limit = 0,
        float $minimumSavingPercent = 5,
        ?callable $reporter = null,
    ): array {
        if (! function_exists('imagewebp')) {
            throw new RuntimeException('PHP GD with WebP support is required.');
        }

        $disk = Storage::disk('public');
        $manifestDisk = Storage::disk('local');
        $manifest = $this->loadManifest($manifestDisk);
        $candidates = $this->collectCandidates();
        $candidates = array_filter(
            $candidates,
            fn (string $path): bool => ! preg_match('/-optimized(?:-\d+)?\.webp$/i', $path),
            ARRAY_FILTER_USE_KEY,
        );

        $result = [
            'candidates' => count($candidates),
            'optimized' => 0,
            'skipped' => 0,
            'missing' => 0,
            'failed' => 0,
            'references_updated' => 0,
            'bytes_before' => 0,
            'bytes_after' => 0,
            'bytes_saved' => 0,
            'originals_deleted' => 0,
        ];

        if ($deleteOriginals && ! $dryRun) {
            $result['originals_deleted'] += $this->cleanupManifestOriginals(
                $disk,
                $manifest,
                $reporter,
            );
            $this->saveManifest($manifestDisk, $manifest);
        }

        foreach ($candidates as $sourcePath => $candidate) {
            if ($limit > 0 && $result['optimized'] >= $limit) {
                break;
            }

            if (! $disk->exists($sourcePath)) {
                $result['missing']++;
                $this->report($reporter, "MISS  {$sourcePath}");

                continue;
            }

            $temporaryPath = tempnam(sys_get_temp_dir(), 'greeco-existing-image-');

            if ($temporaryPath === false) {
                $result['failed']++;
                $this->report($reporter, "FAIL  {$sourcePath} (cannot create temporary file)");

                continue;
            }

            try {
                $sourceSize = $disk->size($sourcePath);
                $effectiveQuality = $quality ?? $candidate['quality'];

                if (! OptimizedImageUpload::optimize(
                    $disk->path($sourcePath),
                    $temporaryPath,
                    $candidate['max_width'],
                    $candidate['max_height'],
                    $effectiveQuality,
                )) {
                    $result['failed']++;
                    $this->report($reporter, "FAIL  {$sourcePath} (unsupported or unreadable image)");

                    continue;
                }

                $optimizedSize = filesize($temporaryPath);
                $savingPercent = $optimizedSize === false || $sourceSize === 0
                    ? 0
                    : (1 - ($optimizedSize / $sourceSize)) * 100;

                if ($optimizedSize === false || $savingPercent < $minimumSavingPercent) {
                    $result['skipped']++;
                    $this->report(
                        $reporter,
                        sprintf(
                            'SKIP  %s (saving %.1f%% is below %.1f%%)',
                            $sourcePath,
                            $savingPercent,
                            $minimumSavingPercent,
                        ),
                    );

                    continue;
                }

                $destinationPath = $this->destinationPath($disk, $sourcePath);
                if ($dryRun) {
                    $result['bytes_before'] += $sourceSize;
                    $result['bytes_after'] += $optimizedSize;
                    $result['bytes_saved'] += $sourceSize - $optimizedSize;
                    $result['optimized']++;
                    $this->report(
                        $reporter,
                        $this->formatSaving('DRY', $sourcePath, $destinationPath, $sourceSize, $optimizedSize),
                    );

                    continue;
                }

                $stream = fopen($temporaryPath, 'rb');

                if ($stream === false || ! $disk->writeStream($destinationPath, $stream)) {
                    if (is_resource($stream)) {
                        fclose($stream);
                    }

                    throw new RuntimeException("Cannot write optimized image: {$destinationPath}");
                }

                fclose($stream);
                $disk->setVisibility($destinationPath, 'public');

                try {
                    $updated = DB::transaction(
                        fn (): int => $this->updateReferences($candidate['references'], $sourcePath, $destinationPath),
                    );
                } catch (Throwable $exception) {
                    $disk->delete($destinationPath);

                    throw $exception;
                }

                $result['references_updated'] += $updated;
                $result['bytes_before'] += $sourceSize;
                $result['bytes_after'] += $optimizedSize;
                $result['bytes_saved'] += $sourceSize - $optimizedSize;
                $result['optimized']++;
                $manifest[$sourcePath] = [
                    'destination' => $destinationPath,
                    'optimized_at' => now()->toIso8601String(),
                ];

                if ($deleteOriginals && ! $this->isReferenced($sourcePath)) {
                    $disk->delete($sourcePath);
                    $result['originals_deleted']++;
                    unset($manifest[$sourcePath]);
                }

                $this->saveManifest($manifestDisk, $manifest);
                $this->report(
                    $reporter,
                    $this->formatSaving('DONE', $sourcePath, $destinationPath, $sourceSize, $optimizedSize),
                );
            } catch (Throwable $exception) {
                $result['failed']++;
                $this->report($reporter, "FAIL  {$sourcePath} ({$exception->getMessage()})");
                report($exception);
            } finally {
                @unlink($temporaryPath);
            }
        }

        return $result;
    }

    private function loadManifest(Filesystem $disk): array
    {
        if (! $disk->exists(self::MANIFEST_PATH)) {
            return [];
        }

        $manifest = json_decode((string) $disk->get(self::MANIFEST_PATH), true);

        return is_array($manifest) ? $manifest : [];
    }

    private function saveManifest(Filesystem $disk, array $manifest): void
    {
        if ($manifest === []) {
            $disk->delete(self::MANIFEST_PATH);

            return;
        }

        $disk->put(
            self::MANIFEST_PATH,
            json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        );
    }

    private function cleanupManifestOriginals(
        Filesystem $disk,
        array &$manifest,
        ?callable $reporter,
    ): int {
        $deleted = 0;

        foreach ($manifest as $sourcePath => $entry) {
            if ($this->isReferenced($sourcePath)) {
                $this->report($reporter, "KEEP  {$sourcePath} (still referenced)");

                continue;
            }

            if ($disk->exists($sourcePath)) {
                $disk->delete($sourcePath);
                $deleted++;
                $this->report($reporter, "CLEAN {$sourcePath}");
            }

            unset($manifest[$sourcePath]);
        }

        return $deleted;
    }

    private function collectCandidates(): array
    {
        $candidates = [];

        foreach (self::DIRECT_IMAGE_FIELDS as [$modelClass, $field, $maxWidth, $maxHeight, $quality]) {
            $modelClass::query()
                ->whereNotNull($field)
                ->select(['id', $field])
                ->chunkById(200, function ($records) use (
                    &$candidates,
                    $modelClass,
                    $field,
                    $maxWidth,
                    $maxHeight,
                    $quality,
                ): void {
                    foreach ($records as $record) {
                        $value = (string) $record->getAttribute($field);
                        $path = $this->normalizeStoragePath($value);

                        if ($path === null) {
                            continue;
                        }

                        $this->addCandidate(
                            $candidates,
                            $path,
                            $maxWidth,
                            $maxHeight,
                            $quality,
                            [
                                'model' => $modelClass,
                                'id' => $record->getKey(),
                                'field' => $field,
                            ],
                        );
                    }
                });
        }

        Setting::query()
            ->where('type', 'image')
            ->whereNotNull('value')
            ->select(['id', 'value'])
            ->chunkById(200, function ($records) use (&$candidates): void {
                foreach ($records as $record) {
                    $path = $this->normalizeStoragePath((string) $record->value);

                    if ($path === null) {
                        continue;
                    }

                    $this->addCandidate(
                        $candidates,
                        $path,
                        2560,
                        1440,
                        84,
                        [
                            'model' => Setting::class,
                            'id' => $record->getKey(),
                            'field' => 'value',
                        ],
                    );
                }
            });

        foreach (self::RICH_CONTENT_FIELDS as [$modelClass, $field]) {
            $this->collectContentCandidates($candidates, $modelClass, $field);
        }

        Setting::query()
            ->where('type', 'editor')
            ->whereNotNull('value')
            ->select(['id', 'value'])
            ->chunkById(200, function ($records) use (&$candidates): void {
                foreach ($records as $record) {
                    foreach ($this->extractStoragePaths((string) $record->value) as $path) {
                        $this->addCandidate(
                            $candidates,
                            $path,
                            1920,
                            1920,
                            82,
                            [
                                'model' => Setting::class,
                                'id' => $record->getKey(),
                                'field' => 'value',
                            ],
                        );
                    }
                }
            });

        ksort($candidates);

        return $candidates;
    }

    private function collectContentCandidates(
        array &$candidates,
        string $modelClass,
        string $field,
    ): void {
        $modelClass::query()
            ->whereNotNull($field)
            ->select(['id', $field])
            ->chunkById(200, function ($records) use (&$candidates, $modelClass, $field): void {
                foreach ($records as $record) {
                    foreach ($this->extractStoragePaths((string) $record->getAttribute($field)) as $path) {
                        $this->addCandidate(
                            $candidates,
                            $path,
                            1920,
                            1920,
                            82,
                            [
                                'model' => $modelClass,
                                'id' => $record->getKey(),
                                'field' => $field,
                            ],
                        );
                    }
                }
            });
    }

    private function addCandidate(
        array &$candidates,
        string $path,
        int $maxWidth,
        int $maxHeight,
        int $quality,
        array $reference,
    ): void {
        $candidates[$path] ??= [
            'max_width' => $maxWidth,
            'max_height' => $maxHeight,
            'quality' => $quality,
            'references' => [],
        ];

        $candidates[$path]['max_width'] = min($candidates[$path]['max_width'], $maxWidth);
        $candidates[$path]['max_height'] = min($candidates[$path]['max_height'], $maxHeight);
        $candidates[$path]['quality'] = min($candidates[$path]['quality'], $quality);
        $candidates[$path]['references'][] = $reference;
    }

    private function normalizeStoragePath(string $value): ?string
    {
        $value = trim(html_entity_decode($value));

        if ($value === '' || str_contains($value, "\0")) {
            return null;
        }

        $urlPath = parse_url($value, PHP_URL_PATH);
        $path = is_string($urlPath) ? $urlPath : $value;
        $storagePosition = strpos($path, '/storage/');

        if ($storagePosition !== false) {
            $path = substr($path, $storagePosition + strlen('/storage/'));
        } else {
            $path = preg_replace('#^/?storage/#', '', $path);
        }

        $path = ltrim((string) $path, '/');

        if ($path === '' || str_contains($path, '..')) {
            return null;
        }

        return preg_match('/\.(?:jpe?g|png|webp)$/i', $path) ? $path : null;
    }

    private function extractStoragePaths(string $content): array
    {
        preg_match_all(
            '#(?:/storage/|(?<![A-Za-z0-9_-])storage/)([^"\'()<>?\s\#]+\.(?:jpe?g|png|webp))#i',
            html_entity_decode($content),
            $matches,
        );

        return array_values(array_unique(array_map(
            fn (string $path): string => ltrim(rawurldecode($path), '/'),
            $matches[1],
        )));
    }

    private function destinationPath(Filesystem $disk, string $sourcePath): string
    {
        $directory = pathinfo($sourcePath, PATHINFO_DIRNAME);
        $filename = pathinfo($sourcePath, PATHINFO_FILENAME);
        $prefix = $directory === '.' ? '' : $directory.'/';
        $destination = "{$prefix}{$filename}-optimized.webp";
        $suffix = 2;

        while ($disk->exists($destination)) {
            $destination = "{$prefix}{$filename}-optimized-{$suffix}.webp";
            $suffix++;
        }

        return $destination;
    }

    private function updateReferences(
        array $references,
        string $sourcePath,
        string $destinationPath,
    ): int {
        $updated = 0;

        foreach ($references as $reference) {
            /** @var class-string<Model> $modelClass */
            $modelClass = $reference['model'];
            $value = $modelClass::query()
                ->whereKey($reference['id'])
                ->value($reference['field']);

            if (! is_string($value)) {
                continue;
            }

            $replacement = str_replace($sourcePath, $destinationPath, $value);

            if ($replacement === $value) {
                continue;
            }

            $modelClass::query()
                ->whereKey($reference['id'])
                ->update([$reference['field'] => $replacement]);

            $updated++;
        }

        return $updated;
    }

    private function isReferenced(string $path): bool
    {
        foreach (self::DIRECT_IMAGE_FIELDS as [$modelClass, $field]) {
            if ($modelClass::query()->where($field, 'like', "%{$path}%")->exists()) {
                return true;
            }
        }

        if (Setting::query()->where('value', 'like', "%{$path}%")->exists()) {
            return true;
        }

        foreach (self::RICH_CONTENT_FIELDS as [$modelClass, $field]) {
            if ($modelClass::query()->where($field, 'like', "%{$path}%")->exists()) {
                return true;
            }
        }

        return false;
    }

    private function formatSaving(
        string $status,
        string $sourcePath,
        string $destinationPath,
        int $sourceSize,
        int $optimizedSize,
    ): string {
        $percent = round((1 - ($optimizedSize / $sourceSize)) * 100, 1);

        return sprintf(
            '%s  %s -> %s (%s saved)',
            $status,
            $sourcePath,
            $destinationPath,
            "{$percent}%",
        );
    }

    private function report(?callable $reporter, string $message): void
    {
        if ($reporter !== null) {
            $reporter($message);
        }
    }
}
