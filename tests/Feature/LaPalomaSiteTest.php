<?php

namespace Tests\Feature;

use Tests\TestCase;

class LaPalomaSiteTest extends TestCase
{
    public function test_homepage_returns_200(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_homepage_has_schema(): void
    {
        $response = $this->get('/');
        $response->assertSee('schema.org');
    }

    public function test_sitemap_returns_xml(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
    }

    public function test_robots_txt_exists(): void
    {
        $response = $this->get('/robots.txt');
        $response->assertStatus(200);
    }

    public function test_404_page(): void
    {
        $response = $this->get('/nonexistent-page-test');
        $response->assertStatus(404);
        $response->assertSee('Page not found');
    }

    public function test_panel_login_page_loads(): void
    {
        $response = $this->get('/panel/login');
        $response->assertStatus(200);
    }

    public function test_panel_requires_auth(): void
    {
        $response = $this->get('/panel');
        $response->assertStatus(302);
    }
}
