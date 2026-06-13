<?php

namespace App\Filament\Resources\Banners\Schemas;

use App\Support\OptimizedImageUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cấu hình Banner')
                    ->schema([
                        OptimizedImageUpload::configure(
                            FileUpload::make('image')->label('Hình ảnh banner'),
                            3840,
                            2160,
                            84,
                            'Ảnh sẽ giữ độ nét tối đa 4K (3840×2160) và chuyển sang WebP để tải nhanh hơn.',
                        )
                            ->disk('public')
                            ->directory('banners')
                            ->required(),
                        TextInput::make('url')
                            ->label('Đường dẫn liên kết (khi click vào ảnh)')
                            ->maxLength(255),
                        Toggle::make('is_active')
                            ->label('Hoạt động')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Thứ tự hiển thị')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }
}
