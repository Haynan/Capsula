<?php

namespace App\Http\Requests\Site;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PublicLeadRequest extends SiteRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'state' => $this->filled('state') ? Str::upper((string) $this->state) : null,
            'source' => 'site',
            'origin_page' => $this->input('origin_page') ?: parse_url((string) url()->previous(), PHP_URL_PATH),
            'consent_at' => now(),
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
            'product_id' => ['required', 'exists:products,id'],
            'message' => ['required', 'string'],
            'consent' => ['accepted'],
            'consent_at' => ['required', 'date'],
            'origin_page' => ['nullable', 'string', 'max:150'],
            'source' => ['required', 'string', 'max:100'],
            'website' => ['nullable', 'max:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'email' => 'e-mail',
            'phone' => 'telefone',
            'whatsapp' => 'WhatsApp',
            'city' => 'cidade',
            'state' => 'estado',
            'product_id' => 'produto de interesse',
            'message' => 'mensagem',
            'consent' => 'consentimento LGPD',
        ];
    }
}
