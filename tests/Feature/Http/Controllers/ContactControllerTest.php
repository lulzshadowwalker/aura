<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_renders_the_page(): void
    {
        $this->get(route("contact.index"))->assertOk();
    }

    public function test_it_stores_a_message(): void
    {
        $this->post(route("contact.store"), [
            "name" => "John Doe",
            "email" => "john@example.com",
            "message" => "Hello, world!",
        ])
            ->assertRedirect(route("contact.index"))
            ->assertSessionHas("success", "Message sent successfully");
    }

    public function test_it_validates_the_form(): void
    {
        $this->post(route("contact.store"), [
            "name" => "",
            "email" => "",
            "message" => "",
        ])
            ->assertRedirect(route("contact.index"))
            ->assertSessionHasErrors(["name", "email", "message"]);
    }

    public function test_it_redirects_to_the_page_on_failure(): void
    {
        $this->post(route("contact.store"), [
            "name" => "John Doe",
            "email" => "john@example.com",
            "message" => "",
        ])
            ->assertRedirect(route("contact.index"))
            ->assertSessionHasErrors(["message"]);
    }

    public function test_it_redirects_to_the_page_on_success(): void
    {
        $this->post(route("contact.store"), [
            "name" => "John Doe",
            "email" => "john@example.com",
            "message" => "Hello, world!",
        ])
            ->assertRedirect(route("contact.index"))
            ->assertSessionHas("success", "Message sent successfully");
    }
}
