<?php

namespace Tests\Feature;

use App\Enums\LeadPriority;
use App\Enums\LeadStatus;
use App\Enums\OpportunityStatus;
use App\Models\Lead;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadConversionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_convert_lead_to_client(): void
    {
        $user = User::factory()->create();
        $lead = $this->lead();

        $response = $this->actingAs($user)->post(route('admin.leads.convert', $lead), [
            'type' => 'PF',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('clients', [
            'name' => $lead->name,
            'email' => $lead->email,
        ]);
        $this->assertDatabaseHas('leads', [
            'id' => $lead->id,
            'status' => LeadStatus::Converted->value,
        ]);
    }

    public function test_admin_can_convert_lead_and_create_opportunity(): void
    {
        $user = User::factory()->create();
        $lead = $this->lead();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.leads.convert', $lead), [
            'type' => 'PF',
            'create_opportunity' => '1',
            'product_id' => $product->id,
            'title' => 'Nova oportunidade',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('opportunities', [
            'lead_id' => $lead->id,
            'product_id' => $product->id,
            'title' => 'Nova oportunidade',
            'status' => OpportunityStatus::Open->value,
        ]);
    }

    private function lead(): Lead
    {
        return Lead::query()->create([
            'name' => 'Lead Teste',
            'email' => 'lead@example.com',
            'phone' => '(85) 99999-0000',
            'product_id' => Product::factory()->create()->id,
            'source' => 'site',
            'status' => LeadStatus::New,
            'priority' => LeadPriority::Normal,
            'consent_at' => now(),
        ]);
    }
}
