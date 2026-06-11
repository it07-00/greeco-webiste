<?php

namespace App\Filament\Resources\SeoRedirects;

use App\Filament\Resources\SeoRedirects\Pages\CreateSeoRedirect;
use App\Filament\Resources\SeoRedirects\Pages\EditSeoRedirect;
use App\Filament\Resources\SeoRedirects\Pages\ListSeoRedirects;
use App\Filament\Resources\SeoRedirects\Schemas\SeoRedirectForm;
use App\Filament\Resources\SeoRedirects\Tables\SeoRedirectsTable;
use App\Models\SeoRedirect;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SeoRedirectResource extends Resource
{
    protected static ?string $model = SeoRedirect::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;

    protected static ?string $navigationLabel = 'Redirect SEO';

    protected static ?string $modelLabel = 'Redirect SEO';

    protected static ?string $pluralModelLabel = 'Redirect SEO';

    protected static string|\UnitEnum|null $navigationGroup = 'SEO & Cấu hình';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'old_url';

    public static function form(Schema $schema): Schema
    {
        return SeoRedirectForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeoRedirectsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSeoRedirects::route('/'),
            'create' => CreateSeoRedirect::route('/create'),
            'edit' => EditSeoRedirect::route('/{record}/edit'),
        ];
    }
}
