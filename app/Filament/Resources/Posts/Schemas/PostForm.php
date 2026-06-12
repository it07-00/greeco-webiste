<?php

namespace App\Filament\Resources\Posts\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('PostTabs')
                    ->tabs([
                        Tab::make('Thông tin chính')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Tiêu đề bài viết')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Select::make('post_category_id')
                                    ->label('Danh mục bài viết')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload(),
                                Textarea::make('excerpt')
                                    ->label('Mô tả ngắn/Trích dẫn')
                                    ->rows(3),
                                TagsInput::make('tags')
                                    ->label('Thẻ (Tags)')
                                    ->placeholder('Nhập tag và ấn Enter')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Nội dung')
                            ->schema([
                                RichEditor::make('content')
                                    ->label('Nội dung bài viết')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('posts/attachments')
                                    ->resizableImages()
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Hình ảnh')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->label('Ảnh đại diện')
                                    ->image()
                                    ->disk('public')
                                    ->directory('posts'),
                                FileUpload::make('og_image')
                                    ->label('Ảnh chia sẻ Facebook/Zalo')
                                    ->image()
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
                                Toggle::make('is_published')
                                    ->label('Đã xuất bản')
                                    ->default(false),
                                DateTimePicker::make('published_at')
                                    ->label('Ngày xuất bản')
                                    ->default(now()),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
