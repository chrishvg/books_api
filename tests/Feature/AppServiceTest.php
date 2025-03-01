<?php

namespace Tests\Feature;

use Tests\TestCase;

class AppServiceTest extends TestCase
{
    public function test_app_endpoint()
    {
        $response = $this->getJson('/api/app/21824');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     "id", "author_info" => ["name", "url"], "title",
                     "version", "url", "short_description", "license",
                     "thumbnail", "rating", "total_downloads", "compatible"
                 ]);
    }

    public function test_for_invalid_id()
    {
        $response = $this->getJson('/api/app/99999');
        $response->assertStatus(404)
                 ->assertJson(["error" => "App not found"]);
    }
}