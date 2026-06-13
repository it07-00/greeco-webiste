<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LibraryPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_library_only_displays_legal_documents_content(): void
    {
        $this->get(route('library'))
            ->assertOk()
            ->assertSee('Văn bản pháp luật')
            ->assertDontSee('Capability Profile')
            ->assertDontSee('Xem trực tuyến');
    }

    public function test_capability_profile_has_its_own_page_and_header_link(): void
    {
        $this->get(route('capability-profile'))
            ->assertOk()
            ->assertSee('Hồ sơ năng lực')
            ->assertSee('Capability Profile')
            ->assertSee('Xem trực tuyến')
            ->assertSee('href="'.route('capability-profile').'"', false);
    }
}
