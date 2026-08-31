<?php

namespace Tests\Feature\Admin;

use App\Livewire\Admin\HeroSlides\Manager;
use App\Models\HeroSlide;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class HeroSlidesManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_saving_a_slide_dispatches_a_toast(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Manager::class)
            ->call('startCreate')
            ->set('alt', 'Gedung Sekolah')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('toast', type: 'success');

        $this->assertDatabaseHas('hero_slides', ['alt' => 'Gedung Sekolah']);
    }

    public function test_deleting_a_slide_dispatches_a_toast(): void
    {
        $user = User::factory()->create();
        $slide = HeroSlide::create(['alt' => 'Slide Lama', 'order' => 0]);

        Livewire::actingAs($user)
            ->test(Manager::class)
            ->call('delete', $slide->id)
            ->assertDispatched('toast', type: 'success');

        $this->assertDatabaseMissing('hero_slides', ['id' => $slide->id]);
    }

    public function test_uploading_a_mobile_image_saves_it(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Manager::class)
            ->call('startCreate')
            ->set('alt', 'Gedung Sekolah')
            ->set('mobileImage', UploadedFile::fake()->create('mobile.jpg', 10, 'image/jpeg'))
            ->call('save')
            ->assertHasNoErrors();

        $slide = HeroSlide::where('alt', 'Gedung Sekolah')->firstOrFail();
        $this->assertNotNull($slide->mobile_image);

        $path = 'uploads/hero-slides/'.basename(parse_url($slide->mobile_image, PHP_URL_PATH));
        Storage::disk('public')->assertExists($path);
    }

    public function test_removing_a_mobile_image_clears_it_and_deletes_the_file(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        Storage::disk('public')->put('uploads/hero-slides/old-mobile.jpg', 'contents');
        $slide = HeroSlide::create([
            'alt' => 'Slide Lama',
            'order' => 0,
            'mobile_image' => Storage::disk('public')->url('uploads/hero-slides/old-mobile.jpg'),
        ]);

        Livewire::actingAs($user)
            ->test(Manager::class)
            ->call('startEdit', $slide->id)
            ->call('removeMobileImage')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertNull($slide->refresh()->mobile_image);
        Storage::disk('public')->assertMissing('uploads/hero-slides/old-mobile.jpg');
    }
}
