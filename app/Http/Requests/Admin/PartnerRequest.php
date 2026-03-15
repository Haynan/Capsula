<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PartnerRequest extends AdminRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug((string) $this->input('name')),
            'is_active' => $this->boolean('is_active'),
            'remove_logo' => $this->boolean('remove_logo'),
        ]);
    }

    public function rules(): array
    {
        $partnerId = $this->route('partner')?->id;

        return [
            'name' => ['required', 'string', 'max:150'],
            'slug' => ['required', 'string', 'max:160', Rule::unique('partners', 'slug')->ignore($partnerId)],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ];
    }
}
