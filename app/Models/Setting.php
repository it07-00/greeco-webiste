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

    public static function getValue(string $key, $default = null)
    {
        static $settings = null;
        if ($settings === null) {
            $settings = self::pluck('value', 'key');
        }
        return $settings->get($key) ?? $default;
    }
}
