<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin liên hệ gửi từ website')
                    ->schema([
                        TextInput::make('name')
                            ->label('Họ tên')
                            ->readOnly(),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->readOnly(),
                        TextInput::make('phone')
                            ->label('Số điện thoại')
                            ->readOnly(),
                        TextInput::make('subject')
                            ->label('Tiêu đề')
                            ->readOnly(),
                        Textarea::make('message')
                            ->label('Nội dung tin nhắn')
                            ->rows(5)
                            ->readOnly()
                            ->columnSpanFull(),
                        Toggle::make('is_read')
                            ->label('Đã đọc')
                            ->default(false),
                    ])->columns(2)
            ]);
    }
}
