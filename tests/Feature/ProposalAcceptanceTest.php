<?php

namespace Tests\Feature;

use App\Enums\ClientServiceStatus;
use App\Enums\OpportunityStatus;
use App\Enums\ProposalStatus;
use App\Enums\RenewalStatus;
use App\Models\Client;
use App\Models\Opportunity;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProposalAcceptanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_accepted_proposal_updates_opportunity_to_won(): void
    {
        [$user, $proposal] = $this->proposalScenario();

        $response = $this->actingAs($user)->post(route('admin.proposals.accept', $proposal), []);

        $response->assertRedirect();
        $this->assertDatabaseHas('proposals', [
            'id' => $proposal->id,
            'status' => ProposalStatus::Accepted->value,
        ]);
        $this->assertDatabaseHas('opportunities', [
            'id' => $proposal->opportunity_id,
            'status' => OpportunityStatus::Won->value,
        ]);
    }

    public function test_accepted_proposal_can_generate_client_service_history(): void
    {
        [$user, $proposal] = $this->proposalScenario();

        $this->actingAs($user)->post(route('admin.proposals.accept', $proposal), [
            'create_client_service' => '1',
            'service_title' => 'Seguro ativo',
            'service_status' => ClientServiceStatus::Active->value,
            'service_start_date' => now()->toDateString(),
        ]);

        $this->assertDatabaseHas('client_services', [
            'client_id' => $proposal->opportunity->client_id,
            'title' => 'Seguro ativo',
        ]);
    }

    public function test_accepted_proposal_can_generate_renewal(): void
    {
        [$user, $proposal] = $this->proposalScenario();

        $this->actingAs($user)->post(route('admin.proposals.accept', $proposal), [
            'create_client_service' => '1',
            'service_title' => 'Seguro ativo',
            'service_status' => ClientServiceStatus::Active->value,
            'create_renewal' => '1',
            'renewal_due_date' => now()->addYear()->toDateString(),
            'renewal_status' => RenewalStatus::Pending->value,
        ]);

        $this->assertDatabaseHas('renewals', [
            'client_id' => $proposal->opportunity->client_id,
            'status' => RenewalStatus::Pending->value,
        ]);
    }

    private function proposalScenario(): array
    {
        $user = User::factory()->create();
        $client = Client::query()->create([
            'type' => 'PF',
            'name' => 'Cliente da proposta',
            'email' => 'cliente@proposta.com',
        ]);

        $opportunity = Opportunity::query()->create([
            'client_id' => $client->id,
            'product_id' => Product::factory()->create()->id,
            'title' => 'Oportunidade teste',
            'status' => OpportunityStatus::Open,
        ]);

        $proposal = Proposal::query()->create([
            'opportunity_id' => $opportunity->id,
            'title' => 'Proposta teste',
            'status' => ProposalStatus::Sent,
        ]);

        return [$user, $proposal];
    }
}
