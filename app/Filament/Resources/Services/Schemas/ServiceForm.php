<?php

namespace App\Filament\Resources\Services\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('ServiceTabs')
                    ->tabs([
                        Tab::make('Thông tin chính')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Tên dịch vụ')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Select::make('service_category_id')
                                    ->label('Danh mục dịch vụ')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload(),
                                TextInput::make('icon')
                                    ->label('Icon class (ví dụ: flaticon-...)')
                                    ->maxLength(255),
                                Textarea::make('short_description')
                                    ->label('Mô tả ngắn')
                                    ->rows(3),
                            ]),
                        Tab::make('Nội dung')
                            ->schema([
                                RichEditor::make('content')
                                    ->label('Nội dung chi tiết')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('services/attachments')
                                    ->resizableImages()
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Hình ảnh')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->label('Ảnh đại diện')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->directory('services'),
                                FileUpload::make('og_image')
                                    ->label('Ảnh chia sẻ Facebook/Zalo')
                                    ->image()
                                    ->imageEditor()
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
                                Toggle::make('is_featured')
                                    ->label('Nổi bật')
                                    ->default(false),
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
