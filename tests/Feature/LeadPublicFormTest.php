<?php

namespace Tests\Feature;

use App\Mail\NewLeadNotification;
use App\Models\Lead;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class LeadPublicFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitor_can_submit_public_form_and_persist_lead(): void
    {
        Mail::fake();
        $product = Product::factory()->create();

        $response = $this->post(route('site.proposals.store'), $this->payload($product->id));

        $response->assertSessionHas('status');
        $this->assertDatabaseHas('leads', [
            'name' => 'Cliente Exemplo',
            'email' => 'cliente@example.com',
            'product_id' => $product->id,
            'source' => 'site',
        ]);
    }

    public function test_public_form_attempts_to_send_email(): void
    {
        Mail::fake();
        $product = Product::factory()->create();

        $this->post(route('site.proposals.store'), $this->payload($product->id));

        Mail::assertSent(NewLeadNotification::class);
    }

    public function test_email_failure_does_not_prevent_lead_persistence(): void
    {
        $product = Product::factory()->create();

        Mail::shouldReceive('to')
            ->once()
            ->andReturn(new class {
                public function send($mailable): void
                {
                    throw new \RuntimeException('SMTP indisponivel');
                }
            });

        $response = $this->post(route('site.proposals.store'), $this->payload($product->id));

        $response->assertSessionHas('status');
        $this->assertDatabaseCount('leads', 1);
    }

    private function payload(int $productId): array
    {
        return [
            'name' => 'Cliente Exemplo',
            'email' => 'cliente@example.com',
            'phone' => '(85) 99999-9999',
            'whatsapp' => '(85) 99999-9999',
            'city' => 'Fortaleza',
            'state' => 'CE',
            'product_id' => $productId,
            'message' => 'Tenho interesse em uma proposta.',
            'consent' => '1',
            'origin_page' => '/',
        ];
    }
}
