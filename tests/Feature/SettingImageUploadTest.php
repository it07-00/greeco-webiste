<?php

namespace Tests\Feature;

use App\Filament\Resources\Settings\Schemas\SettingForm;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\FormsComponent;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SettingImageUploadTest extends TestCase
{
    public function test_setting_file_upload_allows_files_up_to_100_mb(): void
    {
        $livewire = new class extends FormsComponent
        {
            public array $data = [];

            public function render(): string
            {
                return '';
            }
        };

        $schema = SettingForm::configure(Schema::make($livewire))
            ->statePath('data');

        $fileUpload = collect($schema->getFlatComponents(withHidden: true))
            ->first(fn ($component) => $component instanceof FileUpload && $component->getName() === 'file_value');

        $this->assertInstanceOf(FileUpload::class, $fileUpload);
        $this->assertSame(102400, $fileUpload->getMaxSize());
        $this->assertContains('max:102400', config('livewire.temporary_file_upload.rules'));
    }

    public function test_setting_image_upload_uses_the_public_disk(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('settings/contact_image.webp', 'image');

        $livewire = new class extends FormsComponent
        {
            public array $data = [];

            public function render(): string
            {
                return '';
            }
        };

        $schema = SettingForm::configure(Schema::make($livewire))
            ->statePath('data')
            ->fill([
                'type' => 'image',
                'image_value' => 'settings/contact_image.webp',
            ]);

        $imageUpload = collect($schema->getFlatComponents(withHidden: true))
            ->first(fn ($component) => $component instanceof FileUpload && $component->getName() === 'image_value');

        $this->assertInstanceOf(FileUpload::class, $imageUpload);
        $this->assertSame('public', $imageUpload->getDiskName());
        $this->assertTrue($imageUpload->getDisk()->exists('settings/contact_image.webp'));
        $this->assertCount(1, $livewire->data['image_value']);
        $this->assertContains('settings/contact_image.webp', $livewire->data['image_value']);
    }
}
