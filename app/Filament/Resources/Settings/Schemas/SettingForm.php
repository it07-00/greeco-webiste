<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cấu hình hệ thống')
                    ->schema([
                        TextInput::make('key')
                            ->label('Khóa (Key)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Select::make('group')
                            ->label('Nhóm cấu hình')
                            ->options([
                                'general' => 'Thông tin chung',
                                'contact' => 'Thông tin liên hệ',
                                'social' => 'Mạng xã hội',
                                'seo' => 'SEO mặc định',
                            ])
                            ->default('general')
                            ->required(),
                        Select::make('type')
                            ->label('Kiểu dữ liệu')
                            ->options([
                                'text' => 'Văn bản ngắn (Text)',
                                'textarea' => 'Văn bản dài (Textarea)',
                                'editor' => 'Trình soạn thảo (Rich Text)',
                            ])
                            ->default('text')
                            ->required(),
                        Textarea::make('value')
                            ->label('Giá trị')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
            ]);
    }
}
