<?php

namespace Tests\Feature;

use App\Models\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageSliderTest extends TestCase
{
    use RefreshDatabase;

    public function test_swiper_styles_load_before_the_theme_styles(): void
    {
        Partner::query()->create([
            'name' => 'Test Partner',
            'logo' => 'partners/test.png',
            'is_active' => true,
        ]);

        $content = $this->get('/')
            ->assertOk()
            ->getContent();

        $swiperPosition = strpos($content, 'assets/css/swiper.css');
        $themePosition = strpos($content, 'assets/css/style.css');

        $this->assertNotFalse($swiperPosition);
        $this->assertNotFalse($themePosition);
        $this->assertLessThan($themePosition, $swiperPosition);
        $this->assertSame(1, substr_count($content, 'assets/css/swiper.css'));
        $this->assertSame(1, substr_count($content, 'assets/js/swiper.js'));
    }
}
