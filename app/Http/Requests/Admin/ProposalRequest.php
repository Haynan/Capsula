<?php

namespace App\Http\Requests\Admin;

use App\Enums\ProposalStatus;
use Illuminate\Validation\Rules\Enum;

class ProposalRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'opportunity_id' => ['required', 'exists:opportunities,id'],
            'partner_id' => ['nullable', 'exists:partners,id'],
            'title' => ['required', 'string', 'max:150'],
            'amount' => ['nullable', 'numeric', 'min:0'],
            'installments' => ['nullable', 'string', 'max:50'],
            'valid_until' => ['nullable', 'date'],
            'status' => ['required', new Enum(ProposalStatus::class)],
            'details' => ['nullable', 'string'],
        ];
    }
}
