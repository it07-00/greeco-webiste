<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    public function up(): void
    {
        $this->copyDefaultBanners('webp');

        foreach (['5', '6'] as $name) {
            DB::table('banners')
                ->where('image', "banners/{$name}.png")
                ->update(['image' => "banners/{$name}.webp"]);
        }
    }

    public function down(): void
    {
        $this->copyDefaultBanners('png');

        foreach (['5', '6'] as $name) {
            DB::table('banners')
                ->where('image', "banners/{$name}.webp")
                ->update(['image' => "banners/{$name}.png"]);
        }
    }

    private function copyDefaultBanners(string $extension): void
    {
        foreach (['5', '6'] as $name) {
            $source = public_path("assets/images/{$name}.{$extension}");

            if (File::exists($source)) {
                Storage::disk('public')->put(
                    "banners/{$name}.{$extension}",
                    File::get($source),
                );
            }
        }
    }
};
