<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin Banner / Slider')
                    ->schema([
                        TextInput::make('title')
                            ->label('Tiêu đề chính')
                            ->maxLength(255),
                        TextInput::make('subtitle')
                            ->label('Tiêu đề phụ (Subtitle)')
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Mô tả ngắn')
                            ->rows(3),
                    ]),
                Section::make('Nút hành động (Call to Action)')
                    ->schema([
                        TextInput::make('button_text')
                            ->label('Chữ trên nút (Button Text)')
                            ->maxLength(255),
                        TextInput::make('button_url')
                            ->label('Đường dẫn nút (Button URL)')
                            ->maxLength(255),
                    ])->columns(2),
                Section::make('Hình ảnh & Trạng thái')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Hình ảnh banner')
                            ->image()
                            ->directory('banners')
                            ->required(),
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
