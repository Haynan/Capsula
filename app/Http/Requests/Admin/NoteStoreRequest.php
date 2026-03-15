<?php

namespace App\Http\Requests\Admin;

class NoteStoreRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'noteable_type' => ['required', 'in:lead,client,opportunity,proposal,renewal'],
            'noteable_id' => ['required', 'integer', 'min:1'],
            'content' => ['required', 'string'],
        ];
    }
}
