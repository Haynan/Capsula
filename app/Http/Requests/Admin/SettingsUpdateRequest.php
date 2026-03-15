<?php

namespace App\Http\Requests\Admin;

class SettingsUpdateRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'site_name' => ['required', 'string', 'max:150'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'company_phone' => ['nullable', 'string', 'max:50'],
            'company_whatsapp' => ['nullable', 'string', 'max:50'],
            'company_email' => ['nullable', 'email', 'max:150'],
            'company_address' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string'],
            'hero_cta_text' => ['nullable', 'string', 'max:100'],
            'seo_home_title' => ['nullable', 'string', 'max:255'],
            'seo_home_description' => ['nullable', 'string', 'max:255'],
            'seo_partners_title' => ['nullable', 'string', 'max:255'],
            'seo_partners_description' => ['nullable', 'string', 'max:255'],
            'seo_contact_title' => ['nullable', 'string', 'max:255'],
            'seo_contact_description' => ['nullable', 'string', 'max:255'],
        ];
    }
}
