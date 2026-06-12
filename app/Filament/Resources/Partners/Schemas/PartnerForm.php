<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin đối tác')
                    ->schema([
                        TextInput::make('name')
                            ->label('Tên đối tác')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('website_url')
                            ->label('Đường dẫn Website')
                            ->url()
                            ->maxLength(255),
                        FileUpload::make('logo')
                            ->label('Logo đối tác')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('partners'),
                        Toggle::make('is_active')
                            ->label('Hiển thị')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Thứ tự hiển thị')
                            ->numeric()
                            ->default(0),
                    ])
            ]);
    }
}
