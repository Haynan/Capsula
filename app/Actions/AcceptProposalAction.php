<?php

namespace App\Actions;

use App\Enums\ClientServiceStatus;
use App\Enums\OpportunityStatus;
use App\Enums\ProposalStatus;
use App\Enums\RenewalStatus;
use App\Models\ClientService;
use App\Models\Proposal;
use App\Models\Renewal;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AcceptProposalAction
{
    public function execute(Proposal $proposal, array $data = []): array
    {
        return DB::transaction(function () use ($proposal, $data) {
            $proposal->update([
                'status' => ProposalStatus::Accepted,
            ]);

            $opportunity = $proposal->opportunity;
            $opportunity->update([
                'status' => OpportunityStatus::Won,
            ]);

            $clientService = null;
            $renewal = null;
            $client = $opportunity->client;

            if ($client && Arr::get($data, 'create_client_service')) {
                $clientService = Arr::get($data, 'client_service_id')
                    ? ClientService::query()->whereKey($data['client_service_id'])->first()
                    : new ClientService();

                $clientService->fill([
                    'client_id' => $client->id,
                    'product_id' => $opportunity->product_id,
                    'partner_id' => Arr::get($data, 'partner_id', $proposal->partner_id),
                    'title' => Arr::get($data, 'service_title', $proposal->title),
                    'description' => Arr::get($data, 'service_description', $proposal->details),
                    'start_date' => Arr::get($data, 'service_start_date', now()->toDateString()),
                    'renewal_date' => Arr::get($data, 'service_renewal_date'),
                    'status' => Arr::get($data, 'service_status', ClientServiceStatus::Active->value),
                    'notes' => Arr::get($data, 'service_notes'),
                ]);
                $clientService->save();
            }

            if ($client && Arr::get($data, 'create_renewal')) {
                $renewal = Renewal::query()->create([
                    'client_id' => $client->id,
                    'client_service_id' => $clientService?->id,
                    'product_id' => $opportunity->product_id,
                    'partner_id' => Arr::get($data, 'partner_id', $proposal->partner_id),
                    'due_date' => Arr::get($data, 'renewal_due_date'),
                    'status' => Arr::get($data, 'renewal_status', RenewalStatus::Pending->value),
                    'notes' => Arr::get($data, 'renewal_notes'),
                ]);
            }

            return [
                'proposal' => $proposal->refresh(),
                'opportunity' => $opportunity->refresh(),
                'client_service' => $clientService?->refresh(),
                'renewal' => $renewal?->refresh(),
            ];
        });
    }
}
