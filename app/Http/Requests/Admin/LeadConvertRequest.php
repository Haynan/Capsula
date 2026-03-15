<?php

namespace App\Http\Requests\Admin;

class LeadConvertRequest extends AdminRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'create_opportunity' => $this->boolean('create_opportunity'),
        ]);
    }

    public function rules(): array
    {
        return [
            'type' => ['nullable', 'in:PF,PJ'],
            'create_opportunity' => ['nullable', 'boolean'],
            'product_id' => ['nullable', 'required_if:create_opportunity,1', 'exists:products,id'],
            'title' => ['nullable', 'string', 'max:150'],
            'estimated_value' => ['nullable', 'numeric', 'min:0'],
            'expected_close_date' => ['nullable', 'date'],
            'next_action_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
