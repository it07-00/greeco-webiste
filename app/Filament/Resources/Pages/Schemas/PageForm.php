<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Support\OptimizedImageUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('PageTabs')
                    ->tabs([
                        Tab::make('Thông tin chính')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Tiêu đề')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Textarea::make('excerpt')
                                    ->label('Mô tả ngắn/Trích dẫn')
                                    ->rows(3),
                            ]),
                        Tab::make('Nội dung')
                            ->schema([
                                OptimizedImageUpload::configureRichEditor(
                                    RichEditor::make('content')->label('Nội dung chi tiết'),
                                )
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('pages/attachments')
                                    ->resizableImages()
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Hình ảnh')
                            ->schema([
                                OptimizedImageUpload::configure(
                                    FileUpload::make('thumbnail')->label('Ảnh đại diện'),
                                    2560,
                                    1440,
                                )
                                    ->disk('public')
                                    ->directory('pages'),
                                OptimizedImageUpload::configure(
                                    FileUpload::make('og_image')->label('Ảnh chia sẻ Facebook/Zalo (og:image)'),
                                    1600,
                                    900,
                                )
                                    ->disk('public')
                                    ->directory('seo/og-images'),
                            ]),
                        Tab::make('SEO')
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Meta Title')
                                    ->maxLength(255),
                                Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->rows(3),
                                TextInput::make('meta_keywords')
                                    ->label('Meta Keywords'),
                                TextInput::make('canonical_url')
                                    ->label('Canonical URL'),
                            ]),
                        Tab::make('Trạng thái')
                            ->schema([
                                Toggle::make('is_indexable')
                                    ->label('Cho Google index')
                                    ->default(true),
                                Toggle::make('is_active')
                                    ->label('Hiển thị')
                                    ->default(true),
                                TextInput::make('sort_order')
                                    ->label('Thứ tự hiển thị')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
