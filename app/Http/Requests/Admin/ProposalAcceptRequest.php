<?php

namespace App\Http\Requests\Admin;

use App\Enums\ClientServiceStatus;
use App\Enums\RenewalStatus;
use Illuminate\Validation\Rules\Enum;

class ProposalAcceptRequest extends AdminRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'create_client_service' => $this->boolean('create_client_service'),
            'create_renewal' => $this->boolean('create_renewal'),
        ]);
    }

    public function rules(): array
    {
        return [
            'client_service_id' => ['nullable', 'exists:client_services,id'],
            'create_client_service' => ['nullable', 'boolean'],
            'service_title' => ['nullable', 'required_if:create_client_service,1', 'string', 'max:150'],
            'service_description' => ['nullable', 'string'],
            'service_start_date' => ['nullable', 'date'],
            'service_renewal_date' => ['nullable', 'date'],
            'service_status' => ['nullable', new Enum(ClientServiceStatus::class)],
            'service_notes' => ['nullable', 'string'],
            'partner_id' => ['nullable', 'exists:partners,id'],
            'create_renewal' => ['nullable', 'boolean'],
            'renewal_due_date' => ['nullable', 'required_if:create_renewal,1', 'date'],
            'renewal_status' => ['nullable', new Enum(RenewalStatus::class)],
            'renewal_notes' => ['nullable', 'string'],
        ];
    }
}
