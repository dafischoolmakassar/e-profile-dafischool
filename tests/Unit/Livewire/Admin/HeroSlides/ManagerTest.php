<?php

namespace Tests\Unit\Livewire\Admin\HeroSlides;

use App\Livewire\Admin\HeroSlides\Manager;
use Illuminate\Support\Facades\Storage;
use ReflectionMethod;
use Tests\TestCase;

class ManagerTest extends TestCase
{
    private Manager $manager;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        $this->manager = new Manager();
    }

    private function resolveMobileImageUrl(string $directory): ?string
    {
        $method = new ReflectionMethod($this->manager, 'resolveMobileImageUrl');
        $method->setAccessible(true);

        return $method->invoke($this->manager, $directory);
    }

    public function test_resolve_mobile_image_url_keeps_existing_image_when_untouched(): void
    {
        $this->manager->existingMobileImage = 'https://example.com/storage/hero-slides/keep-mobile.jpg';

        $url = $this->resolveMobileImageUrl('hero-slides');

        $this->assertSame('https://example.com/storage/hero-slides/keep-mobile.jpg', $url);
    }

    public function test_resolve_mobile_image_url_returns_null_and_deletes_file_when_removed(): void
    {
        Storage::disk('public')->put('hero-slides/remove-me-mobile.jpg', 'contents');
        $this->manager->existingMobileImage = Storage::disk('public')->url('hero-slides/remove-me-mobile.jpg');
        $this->manager->removeMobileImage();

        $url = $this->resolveMobileImageUrl('hero-slides');

        $this->assertNull($url);
        Storage::disk('public')->assertMissing('hero-slides/remove-me-mobile.jpg');
    }

    public function test_resolve_mobile_image_url_does_not_touch_the_primary_image_state(): void
    {
        $this->manager->existingImage = 'https://example.com/storage/hero-slides/landscape.jpg';
        Storage::disk('public')->put('hero-slides/remove-mobile.jpg', 'contents');
        $this->manager->existingMobileImage = Storage::disk('public')->url('hero-slides/remove-mobile.jpg');
        $this->manager->removeMobileImage();

        $this->resolveMobileImageUrl('hero-slides');

        $this->assertSame('https://example.com/storage/hero-slides/landscape.jpg', $this->manager->existingImage);
        $this->assertFalse($this->manager->imageRemoved);
    }
}
