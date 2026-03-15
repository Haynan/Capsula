<?php

namespace App\Http\Requests\Admin;

use App\Enums\RenewalStatus;
use Illuminate\Validation\Rules\Enum;

class RenewalRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'client_service_id' => ['nullable', 'exists:client_services,id'],
            'product_id' => ['required', 'exists:products,id'],
            'partner_id' => ['nullable', 'exists:partners,id'],
            'due_date' => ['required', 'date'],
            'status' => ['required', new Enum(RenewalStatus::class)],
            'notes' => ['nullable', 'string'],
        ];
    }
}
