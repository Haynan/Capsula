<?php

namespace App\Actions;

use App\Enums\LeadStatus;
use App\Enums\OpportunityStatus;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Opportunity;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ConvertLeadAction
{
    public function execute(Lead $lead, array $data): array
    {
        return DB::transaction(function () use ($lead, $data) {
            $client = Client::query()
                ->where(function ($query) use ($lead) {
                    if ($lead->email) {
                        $query->orWhere('email', $lead->email);
                    }

                    if ($lead->phone) {
                        $query->orWhere('phone', $lead->phone);
                    }

                    if ($lead->whatsapp) {
                        $query->orWhere('whatsapp', $lead->whatsapp);
                    }
                })
                ->first();

            if (! $client) {
                $client = Client::query()->create([
                    'type' => Arr::get($data, 'type', 'PF'),
                    'name' => $lead->name,
                    'email' => $lead->email,
                    'phone' => $lead->phone,
                    'whatsapp' => $lead->whatsapp,
                    'city' => $lead->city,
                    'state' => $lead->state,
                    'notes_summary' => $lead->message,
                ]);
            } else {
                $client->fill([
                    'name' => $client->name ?: $lead->name,
                    'email' => $client->email ?: $lead->email,
                    'phone' => $client->phone ?: $lead->phone,
                    'whatsapp' => $client->whatsapp ?: $lead->whatsapp,
                    'city' => $client->city ?: $lead->city,
                    'state' => $client->state ?: $lead->state,
                    'notes_summary' => $client->notes_summary ?: $lead->message,
                ])->save();
            }

            $opportunity = null;

            if (Arr::get($data, 'create_opportunity')) {
                $opportunity = Opportunity::query()->create([
                    'lead_id' => $lead->id,
                    'client_id' => $client->id,
                    'product_id' => Arr::get($data, 'product_id', $lead->product_id),
                    'title' => Arr::get($data, 'title', 'Oportunidade originada do lead #'.$lead->id),
                    'status' => OpportunityStatus::Open,
                    'estimated_value' => Arr::get($data, 'estimated_value'),
                    'expected_close_date' => Arr::get($data, 'expected_close_date'),
                    'next_action_at' => Arr::get($data, 'next_action_at'),
                    'notes' => Arr::get($data, 'notes', $lead->message),
                ]);
            }

            $lead->update([
                'status' => LeadStatus::Converted,
                'converted_at' => now(),
            ]);

            return [
                'client' => $client,
                'opportunity' => $opportunity,
            ];
        });
    }
}
