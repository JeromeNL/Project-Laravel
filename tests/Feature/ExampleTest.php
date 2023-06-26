<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }

        Log::debug($response->status());

        $response->assertStatus(200);
    }
}
