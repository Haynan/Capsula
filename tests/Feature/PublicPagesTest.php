<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_respond_successfully(): void
    {
        $this->get(route('site.home'))->assertOk();
        $this->get(route('site.partners'))->assertOk();
        $this->get(route('site.contact'))->assertOk();
        $this->get(route('site.privacy'))->assertOk();
    }
}
