<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_renders_the_page(): void
    {
        Collection::factory()->count(3)->create();
        $this->get(route('home.index', ['language' => app()->getLocale()]))->assertOk();
    }
}
