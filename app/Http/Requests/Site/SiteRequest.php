<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

abstract class SiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
}
