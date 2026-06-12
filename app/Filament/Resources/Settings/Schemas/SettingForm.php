<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
                                'image' => 'Hình ảnh (Image)',
                                'file' => 'Tệp tin (File / PDF)',
                            ])
                            ->default('text')
                            ->required()
                            ->live(),

                        TextInput::make('value')
                            ->hidden()
                            ->dehydrated(true),

                         TextInput::make('text_value')
                            ->label('Giá trị')
                            ->visible(fn (callable $get) => in_array($get('type'), ['text', null, '']))
                            ->columnSpanFull(),
 
                         Textarea::make('textarea_value')
                            ->label('Giá trị')
                            ->visible(fn (callable $get) => $get('type') === 'textarea')
                            ->rows(5)
                            ->columnSpanFull(),
 
                         RichEditor::make('editor_value')
                            ->label('Giá trị')
                            ->visible(fn (callable $get) => $get('type') === 'editor')
                            ->columnSpanFull(),
 
                         FileUpload::make('image_value')
                            ->label('Hình ảnh')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visible(fn (callable $get) => $get('type') === 'image')
                            ->columnSpanFull(),
 
                         FileUpload::make('file_value')
                            ->label('Tệp tin (PDF, Doc, v.v.)')
                            ->disk('public')
                            ->directory('settings')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->visible(fn (callable $get) => $get('type') === 'file')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
