<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    protected static function booted()
    {
        static::saved(function ($setting) {
            if ($setting->key === 'favicon') {
                $value = $setting->value;
                if ($value) {
                    $disk = \Illuminate\Support\Facades\Storage::disk('public');
                    if ($disk->exists($value)) {
                        $fullPath = $disk->path($value);
                        $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                        
                        try {
                            // Load image based on extension
                            $image = null;
                            if ($ext === 'webp') {
                                $image = @imagecreatefromwebp($fullPath);
                            } elseif ($ext === 'png') {
                                $image = @imagecreatefrompng($fullPath);
                            } elseif ($ext === 'jpg' || $ext === 'jpeg') {
                                $image = @imagecreatefromjpeg($fullPath);
                            } else {
                                $imageData = @file_get_contents($fullPath);
                                if ($imageData !== false) {
                                    $image = @imagecreatefromstring($imageData);
                                }
                            }
                            
                            if ($image) {
                                // 1. Save 192x192 PNG version (ideal for Google Search & modern devices)
                                if ($ext === 'webp' || $ext === 'jpg' || $ext === 'jpeg') {
                                    // Generate the .png counterpart path
                                    $pngFullPath = str_replace('.' . $ext, '.png', $fullPath);
                                    
                                    $pngWidth = 192;
                                    $pngHeight = 192;
                                    $pngImage = imagecreatetruecolor($pngWidth, $pngHeight);
                                    if ($pngImage) {
                                        imagealphablending($pngImage, false);
                                        imagesavealpha($pngImage, true);
                                        $transparent = imagecolorallocatealpha($pngImage, 0, 0, 0, 127);
                                        imagefilledrectangle($pngImage, 0, 0, $pngWidth, $pngHeight, $transparent);
                                        
                                        imagecopyresampled(
                                            $pngImage,
                                            $image,
                                            0, 0, 0, 0,
                                            $pngWidth, $pngHeight,
                                            imagesx($image), imagesy($image)
                                        );
                                        imagepng($pngImage, $pngFullPath);
                                        imagedestroy($pngImage);
                                    } else {
                                        imagepng($image, $pngFullPath);
                                    }
                                } elseif ($ext === 'png') {
                                    // If it's already a PNG, resize/optimize it in place to 192x192
                                    $pngWidth = 192;
                                    $pngHeight = 192;
                                    if (imagesx($image) > $pngWidth || imagesy($image) > $pngHeight) {
                                        $pngImage = imagecreatetruecolor($pngWidth, $pngHeight);
                                        if ($pngImage) {
                                            imagealphablending($pngImage, false);
                                            imagesavealpha($pngImage, true);
                                            $transparent = imagecolorallocatealpha($pngImage, 0, 0, 0, 127);
                                            imagefilledrectangle($pngImage, 0, 0, $pngWidth, $pngHeight, $transparent);
                                            
                                            imagecopyresampled(
                                                $pngImage,
                                                $image,
                                                0, 0, 0, 0,
                                                $pngWidth, $pngHeight,
                                                imagesx($image), imagesy($image)
                                            );
                                            imagepng($pngImage, $fullPath);
                                            imagedestroy($pngImage);
                                        }
                                    }
                                }
                                
                                // 2. Generate and save favicon.ico in public root
                                // We resize the image to 32x32 for favicon.ico
                                $icoWidth = 32;
                                $icoHeight = 32;
                                $icoImage = imagecreatetruecolor($icoWidth, $icoHeight);
                                if ($icoImage) {
                                    imagealphablending($icoImage, false);
                                    imagesavealpha($icoImage, true);
                                    $transparent = imagecolorallocatealpha($icoImage, 0, 0, 0, 127);
                                    imagefilledrectangle($icoImage, 0, 0, $icoWidth, $icoHeight, $transparent);
                                    
                                    imagecopyresampled(
                                        $icoImage,
                                        $image,
                                        0, 0, 0, 0,
                                        $icoWidth, $icoHeight,
                                        imagesx($image), imagesy($image)
                                    );
                                    
                                    // Output PNG bytes to memory
                                    ob_start();
                                    imagepng($icoImage);
                                    $pngData = ob_get_clean();
                                    
                                    // Wrap in ICO container
                                    $icoData = self::wrapPngInIco($pngData, $icoWidth, $icoHeight);
                                    file_put_contents(public_path('favicon.ico'), $icoData);
                                    imagedestroy($icoImage);
                                }
                                
                                imagedestroy($image);
                            }
                        } catch (\Throwable $e) {
                            \Illuminate\Support\Facades\Log::error('Favicon conversion failed: ' . $e->getMessage());
                        }
                    }
                }
            }
        });
    }

    private static function wrapPngInIco($pngData, $width, $height)
    {
        $header = pack('vvv', 0, 1, 1);
        $widthByte = ($width >= 256) ? 0 : $width;
        $heightByte = ($height >= 256) ? 0 : $height;
        
        $dir = pack('CCCCvvVV', 
            $widthByte, 
            $heightByte, 
            0, // color palette size
            0, // reserved
            1, // color planes
            32, // bits per pixel
            strlen($pngData), // data size
            22 // data offset (6 bytes header + 16 bytes directory entry)
        );
        
        return $header . $dir . $pngData;
    }

    public static function getValue(string $key, $default = null)
    {
        static $settings = null;
        if ($settings === null) {
            $settings = self::pluck('value', 'key');
        }
        return $settings->get($key) ?? $default;
    }
}
