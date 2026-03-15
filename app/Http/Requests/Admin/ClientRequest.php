<?php

namespace App\Http\Requests\Admin;

use App\Enums\ClientType;
use Illuminate\Validation\Rules\Enum;

class ClientRequest extends AdminRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'state' => $this->filled('state') ? strtoupper((string) $this->state) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'type' => ['required', new Enum(ClientType::class)],
            'name' => ['required', 'string', 'max:150'],
            'document' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:120'],
            'state' => ['nullable', 'string', 'size:2'],
            'address' => ['nullable', 'string', 'max:255'],
            'notes_summary' => ['nullable', 'string'],
        ];
    }
}
