<?php

namespace App\Http\Requests\Admin;

use App\Enums\OpportunityStatus;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Validator;

class OpportunityRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'lead_id' => ['nullable', 'exists:leads,id'],
            'client_id' => ['nullable', 'exists:clients,id'],
            'product_id' => ['required', 'exists:products,id'],
            'title' => ['required', 'string', 'max:150'],
            'status' => ['required', new Enum(OpportunityStatus::class)],
            'estimated_value' => ['nullable', 'numeric', 'min:0'],
            'expected_close_date' => ['nullable', 'date'],
            'next_action_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if (! $this->filled('lead_id') && ! $this->filled('client_id')) {
                $validator->errors()->add('client_id', 'Informe pelo menos um lead ou um cliente para a oportunidade.');
            }
        });
    }
}
