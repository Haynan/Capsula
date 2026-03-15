<?php

namespace App\Http\Requests\Admin;

use App\Enums\ClientServiceStatus;
use Illuminate\Validation\Rules\Enum;

class ClientServiceRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'partner_id' => ['nullable', 'exists:partners,id'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'start_date' => ['nullable', 'date'],
            'renewal_date' => ['nullable', 'date'],
            'status' => ['required', new Enum(ClientServiceStatus::class)],
            'notes' => ['nullable', 'string'],
        ];
    }
}
