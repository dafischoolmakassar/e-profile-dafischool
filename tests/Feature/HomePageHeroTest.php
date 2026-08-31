<?php

namespace Tests\Feature;

use App\Models\HeroSlide;
use App\Models\SchoolSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageHeroTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_whatsapp_button_when_number_is_set(): void
    {
        SchoolSetting::current()->update(['whatsapp_number' => '6281234567890']);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('https://wa.me/6281234567890', false);
    }

    public function test_hides_whatsapp_button_when_number_is_empty(): void
    {
        SchoolSetting::current()->update(['whatsapp_number' => null]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertDontSee('wa.me', false);
    }

    public function test_shows_school_logo_overlay_when_configured(): void
    {
        SchoolSetting::current()->update(['logo' => 'https://example.test/storage/uploads/school-settings/logo.png']);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('id="hero-logo"', false);
        $response->assertSee('https://example.test/storage/uploads/school-settings/logo.png', false);
    }

    public function test_falls_back_to_text_when_logo_is_not_configured(): void
    {
        SchoolSetting::current()->update(['logo' => null]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertDontSee('id="hero-logo"', false);
        $response->assertSee(SchoolSetting::DEFAULT_SCHOOL_NAME, false);
    }

    public function test_does_not_show_headline_or_tagline_overlay(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertDontSee('Sekolah Islam Terpadu — Pendidikan', false);
    }

    public function test_still_shows_logo_badge_without_headline(): void
    {
        SchoolSetting::current()->update(['logo' => 'https://example.test/storage/uploads/school-settings/logo.png']);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('id="hero-logo"', false);
    }

    public function test_slide_photo_has_no_zoom_or_animation_class(): void
    {
        HeroSlide::create(['alt' => 'Gedung Sekolah', 'image' => 'https://example.test/gedung.jpg', 'order' => 0]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertDontSee('animate-kenburns', false);
    }

    public function test_slide_photo_is_full_bleed_on_all_breakpoints(): void
    {
        HeroSlide::create(['alt' => 'Gedung Sekolah', 'image' => 'https://example.test/gedung.jpg', 'order' => 0]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertDontSee('lg:object-contain', false);
        $response->assertDontSee('blur-2xl', false);
    }

    public function test_slide_with_mobile_image_shows_a_mobile_source(): void
    {
        HeroSlide::create([
            'alt' => 'Gedung Sekolah',
            'image' => 'https://example.test/gedung.jpg',
            'mobile_image' => 'https://example.test/gedung-mobile.jpg',
            'order' => 0,
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('<source media="(max-width: 767px)" srcset="https://example.test/gedung-mobile.jpg">', false);
    }

    public function test_slide_without_mobile_image_shows_no_mobile_source(): void
    {
        HeroSlide::create(['alt' => 'Gedung Sekolah', 'image' => 'https://example.test/gedung.jpg', 'order' => 0]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertDontSee('<source media="(max-width: 767px)"', false);
    }
}
