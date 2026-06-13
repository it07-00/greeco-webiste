<?php

namespace App\Console\Commands;

use App\Support\ExistingImageOptimizer;
use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Throwable;

class OptimizeExistingImages extends Command
{
    use ConfirmableTrait;

    protected $signature = 'images:optimize-existing
        {--dry-run : Analyze and estimate savings without changing files or database}
        {--delete-originals : Delete old files after every known reference is updated}
        {--quality= : Override WebP quality from 1 to 100}
        {--min-saving=5 : Skip images that save less than this percentage}
        {--limit=0 : Optimize at most this many images successfully}
        {--force : Run without confirmation in production}';

    protected $description = 'Convert existing uploaded images to smaller WebP files and update their references';

    public function handle(ExistingImageOptimizer $optimizer): int
    {
        if (! $this->option('dry-run') && ! $this->confirmToProceed()) {
            return self::FAILURE;
        }

        $quality = $this->option('quality');
        $quality = $quality === null ? null : (int) $quality;
        $limit = max(0, (int) $this->option('limit'));
        $minimumSaving = (float) $this->option('min-saving');

        if ($quality !== null && ($quality < 1 || $quality > 100)) {
            $this->error('The --quality value must be between 1 and 100.');

            return self::INVALID;
        }

        if ($minimumSaving < 0 || $minimumSaving > 100) {
            $this->error('The --min-saving value must be between 0 and 100.');

            return self::INVALID;
        }

        if ($this->option('dry-run')) {
            $this->warn('DRY RUN: no files or database records will be changed.');
        } elseif (! $this->option('delete-originals')) {
            $this->info('Original files will be kept. Add --delete-originals only after verification.');
        }

        try {
            $result = $optimizer->run(
                dryRun: (bool) $this->option('dry-run'),
                deleteOriginals: (bool) $this->option('delete-originals'),
                quality: $quality,
                limit: $limit,
                minimumSavingPercent: $minimumSaving,
                reporter: fn (string $message) => $this->line($message),
            );
        } catch (Throwable $exception) {
            $this->error($exception->getMessage());

            return self::FAILURE;
        }

        $this->newLine();
        $this->table(
            ['Candidates', 'Optimized', 'Skipped', 'Missing', 'Failed', 'References', 'Originals deleted'],
            [[
                $result['candidates'],
                $result['optimized'],
                $result['skipped'],
                $result['missing'],
                $result['failed'],
                $result['references_updated'],
                $result['originals_deleted'],
            ]],
        );

        $this->info(sprintf(
            'Estimated saving: %s (%s -> %s).',
            $this->formatBytes($result['bytes_saved']),
            $this->formatBytes($result['bytes_before']),
            $this->formatBytes($result['bytes_after']),
        ));

        return $result['failed'] > 0 ? self::FAILURE : self::SUCCESS;
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes < 1024) {
            return "{$bytes} B";
        }

        if ($bytes < 1024 * 1024) {
            return number_format($bytes / 1024, 1).' KiB';
        }

        return number_format($bytes / 1024 / 1024, 2).' MiB';
    }
}
