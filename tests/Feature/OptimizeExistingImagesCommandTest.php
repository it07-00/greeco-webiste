<?php

namespace Tests\Feature;

use App\Models\Banner;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OptimizeExistingImagesCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_dry_run_reports_savings_without_changing_files_or_database(): void
    {
        Storage::fake('public');
        Storage::fake('local');
        $this->storeNoisyPng('banners/legacy.png');

        $banner = Banner::query()->create([
            'image' => 'banners/legacy.png',
            'is_active' => true,
        ]);

        $this->artisan('images:optimize-existing', ['--dry-run' => true])
            ->assertSuccessful();

        $this->assertSame('banners/legacy.png', $banner->fresh()->image);
        Storage::disk('public')->assertExists('banners/legacy.png');
        Storage::disk('public')->assertMissing('banners/legacy-optimized.webp');
    }

    public function test_command_converts_old_images_and_updates_direct_and_rich_text_references(): void
    {
        Storage::fake('public');
        Storage::fake('local');
        $this->storeNoisyPng('banners/legacy.png');
        $this->storeNoisyPng('posts/attachments/legacy-inline.png');

        $banner = Banner::query()->create([
            'image' => 'banners/legacy.png',
            'is_active' => true,
        ]);

        $post = Post::query()->create([
            'title' => 'Bài viết cũ',
            'slug' => 'bai-viet-cu',
            'content' => '<p><img src="https://greeco.vn/storage/posts/attachments/legacy-inline.png"></p>',
            'is_published' => true,
        ]);

        $exitCode = Artisan::call('images:optimize-existing');

        $this->assertSame(0, $exitCode, Artisan::output());

        $this->assertSame('banners/legacy-optimized.webp', $banner->fresh()->image);
        $this->assertStringContainsString(
            '/storage/posts/attachments/legacy-inline-optimized.webp',
            $post->fresh()->content,
        );

        Storage::disk('public')->assertExists([
            'banners/legacy.png',
            'banners/legacy-optimized.webp',
            'posts/attachments/legacy-inline.png',
            'posts/attachments/legacy-inline-optimized.webp',
        ]);

        $this->assertSame(
            'image/webp',
            mime_content_type(Storage::disk('public')->path('banners/legacy-optimized.webp')),
        );
    }

    public function test_originals_are_deleted_only_when_requested(): void
    {
        Storage::fake('public');
        Storage::fake('local');
        $this->storeNoisyPng('banners/legacy.png');

        Banner::query()->create([
            'image' => 'banners/legacy.png',
            'is_active' => true,
        ]);

        $this->artisan('images:optimize-existing')
            ->assertSuccessful();

        Storage::disk('public')->assertExists([
            'banners/legacy.png',
            'banners/legacy-optimized.webp',
        ]);
        Storage::disk('local')->assertExists('image-optimization-manifest.json');

        $this->artisan('images:optimize-existing', ['--delete-originals' => true])
            ->assertSuccessful();

        Storage::disk('public')->assertMissing('banners/legacy.png');
        Storage::disk('public')->assertExists('banners/legacy-optimized.webp');
        Storage::disk('local')->assertMissing('image-optimization-manifest.json');
    }

    public function test_limit_can_process_large_libraries_in_repeated_batches(): void
    {
        Storage::fake('public');
        Storage::fake('local');
        $this->storeNoisyPng('banners/first.png');
        $this->storeNoisyPng('banners/second.png');

        $first = Banner::query()->create([
            'image' => 'banners/first.png',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        $second = Banner::query()->create([
            'image' => 'banners/second.png',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $this->artisan('images:optimize-existing', ['--limit' => 1])
            ->assertSuccessful();
        $this->assertSame('banners/first-optimized.webp', $first->fresh()->image);
        $this->assertSame('banners/second.png', $second->fresh()->image);

        $this->artisan('images:optimize-existing', ['--limit' => 1])
            ->assertSuccessful();
        $this->assertSame('banners/second-optimized.webp', $second->fresh()->image);
    }

    private function storeNoisyPng(string $path): void
    {
        $temporaryPath = tempnam(sys_get_temp_dir(), 'legacy-image-test-');
        $image = imagecreatetruecolor(800, 450);
        $seed = 123456789;

        for ($y = 0; $y < 450; $y++) {
            for ($x = 0; $x < 800; $x++) {
                $seed = (1664525 * $seed + 1013904223) & 0xFFFFFFFF;
                imagesetpixel($image, $x, $y, $seed & 0xFFFFFF);
            }
        }

        imagepng($image, $temporaryPath);
        imagedestroy($image);

        try {
            Storage::disk('public')->put($path, file_get_contents($temporaryPath));
        } finally {
            @unlink($temporaryPath);
        }
    }
}
