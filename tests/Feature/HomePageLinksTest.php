<?php

namespace Tests\Feature;

use App\Models\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageLinksTest extends TestCase
{
    use RefreshDatabase;

    public function test_six_main_service_categories_and_partner_logo_are_clickable(): void
    {
        Partner::query()->create([
            'name' => 'Đối tác mẫu',
            'logo' => 'partners/sample.svg',
            'website_url' => 'https://example.com/doi-tac-mau',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $content = $this->get('/')
            ->assertOk()
            ->assertSee('href="https://example.com/doi-tac-mau"', false)
            ->assertSee('target="_blank"', false)
            ->assertSee('rel="noopener noreferrer"', false)
            ->getContent();

        $this->assertSame(6, substr_count($content, 'class="featured-service-link"'));

        foreach ([
            'services.dao-tao',
            'services.tu-van',
            'services.du-an',
            'services.nghien-cuu',
            'services.hoi-thao',
            'library',
        ] as $routeName) {
            $this->assertStringContainsString('href="'.route($routeName).'"', $content);
        }
    }
}
