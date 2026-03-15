<?php

namespace App\Actions;

use App\Enums\LeadPriority;
use App\Enums\LeadStatus;
use App\Mail\NewLeadNotification;
use App\Models\Lead;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CreateLeadFromPublicFormAction
{
    public function execute(array $data): Lead
    {
        $lead = Lead::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'whatsapp' => $data['whatsapp'] ?? null,
            'city' => $data['city'] ?? null,
            'state' => $data['state'] ?? null,
            'product_id' => $data['product_id'] ?? null,
            'source' => $data['source'] ?? 'site',
            'origin_page' => $data['origin_page'] ?? null,
            'message' => $data['message'] ?? null,
            'status' => LeadStatus::New,
            'priority' => LeadPriority::Normal,
            'consent_at' => $data['consent_at'] ?? now(),
        ]);

        $recipient = Setting::getValue('company_email', config('mail.from.address'));

        try {
            if ($recipient) {
                Mail::to($recipient)->send(new NewLeadNotification($lead));
            }
        } catch (\Throwable $exception) {
            Log::error('Falha ao enviar notificacao de novo lead.', [
                'lead_id' => $lead->id,
                'message' => $exception->getMessage(),
            ]);
        }

        return $lead;
    }
}
