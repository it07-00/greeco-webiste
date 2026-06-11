<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicesIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_services_index_displays_six_clickable_main_categories(): void
    {
        $content = $this->get(route('services.index'))
            ->assertOk()
            ->getContent();

        $this->assertSame(6, substr_count($content, 'class="service-category-link"'));

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
