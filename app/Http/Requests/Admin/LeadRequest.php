<?php

namespace App\Http\Requests\Admin;

use App\Enums\LeadPriority;
use App\Enums\LeadStatus;
use Illuminate\Validation\Rules\Enum;

class LeadRequest extends AdminRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'state' => $this->filled('state') ? strtoupper((string) $this->state) : null,
            'consent_at' => $this->input('consent_at') ?: now(),
            'source' => $this->input('source') ?: 'manual',
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:120'],
            'state' => ['nullable', 'string', 'size:2'],
            'product_id' => ['nullable', 'exists:products,id'],
            'source' => ['required', 'string', 'max:100'],
            'origin_page' => ['nullable', 'string', 'max:150'],
            'message' => ['nullable', 'string'],
            'status' => ['required', new Enum(LeadStatus::class)],
            'priority' => ['required', new Enum(LeadPriority::class)],
            'contacted_at' => ['nullable', 'date'],
            'consent_at' => ['required', 'date'],
        ];
    }
}
