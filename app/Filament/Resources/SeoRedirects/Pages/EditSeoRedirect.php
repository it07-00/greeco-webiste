<?php

namespace App\Filament\Resources\SeoRedirects\Pages;

use App\Filament\Resources\SeoRedirects\SeoRedirectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSeoRedirect extends EditRecord
{
    protected static string $resource = SeoRedirectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
