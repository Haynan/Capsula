@extends('layouts.admin')
@section('title', 'Configurações')
@section('page-title', 'Configurações do site')
@section('content')
<div class="capsula-card">
    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-8">
        @csrf
        @method('PUT')
        <div class="grid gap-6 md:grid-cols-2">
            <div><label class="capsula-label">Nome do site</label><input name="site_name" class="capsula-input" value="{{ old('site_name', $siteSettings['site_name']) }}"></div>
            <div><label class="capsula-label">Tagline</label><input name="site_tagline" class="capsula-input" value="{{ old('site_tagline', $siteSettings['site_tagline']) }}"></div>
            <div><label class="capsula-label">Telefone</label><input name="company_phone" class="capsula-input" value="{{ old('company_phone', $siteSettings['company_phone']) }}"></div>
            <div><label class="capsula-label">WhatsApp</label><input name="company_whatsapp" class="capsula-input" value="{{ old('company_whatsapp', $siteSettings['company_whatsapp']) }}"></div>
            <div><label class="capsula-label">E-mail</label><input name="company_email" type="email" class="capsula-input" value="{{ old('company_email', $siteSettings['company_email']) }}"></div>
            <div><label class="capsula-label">Endereço</label><input name="company_address" class="capsula-input" value="{{ old('company_address', $siteSettings['company_address']) }}"></div>
            <div><label class="capsula-label">Instagram</label><input name="instagram_url" class="capsula-input" value="{{ old('instagram_url', $siteSettings['instagram_url']) }}"></div>
            <div><label class="capsula-label">Facebook</label><input name="facebook_url" class="capsula-input" value="{{ old('facebook_url', $siteSettings['facebook_url']) }}"></div>
            <div class="md:col-span-2"><label class="capsula-label">LinkedIn</label><input name="linkedin_url" class="capsula-input" value="{{ old('linkedin_url', $siteSettings['linkedin_url']) }}"></div>
        </div>
        <div class="grid gap-6">
            <div><label class="capsula-label">Título do hero</label><input name="hero_title" class="capsula-input" value="{{ old('hero_title', $siteSettings['hero_title']) }}"></div>
            <div><label class="capsula-label">Subtítulo do hero</label><textarea name="hero_subtitle" class="capsula-textarea">{{ old('hero_subtitle', $siteSettings['hero_subtitle']) }}</textarea></div>
            <div><label class="capsula-label">Texto do CTA</label><input name="hero_cta_text" class="capsula-input" value="{{ old('hero_cta_text', $siteSettings['hero_cta_text']) }}"></div>
            <div><label class="capsula-label">Vídeo institucional do YouTube</label><input name="institutional_video_url" type="url" class="capsula-input" value="{{ old('institutional_video_url', $siteSettings['institutional_video_url']) }}" placeholder="https://www.youtube.com/watch?v=..."></div>
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div><label class="capsula-label">SEO Home - título</label><input name="seo_home_title" class="capsula-input" value="{{ old('seo_home_title', $siteSettings['seo_home_title']) }}"></div>
            <div><label class="capsula-label">SEO Home - descrição</label><input name="seo_home_description" class="capsula-input" value="{{ old('seo_home_description', $siteSettings['seo_home_description']) }}"></div>
            <div><label class="capsula-label">SEO Parceiros - título</label><input name="seo_partners_title" class="capsula-input" value="{{ old('seo_partners_title', $siteSettings['seo_partners_title']) }}"></div>
            <div><label class="capsula-label">SEO Parceiros - descrição</label><input name="seo_partners_description" class="capsula-input" value="{{ old('seo_partners_description', $siteSettings['seo_partners_description']) }}"></div>
            <div><label class="capsula-label">SEO Contato - título</label><input name="seo_contact_title" class="capsula-input" value="{{ old('seo_contact_title', $siteSettings['seo_contact_title']) }}"></div>
            <div><label class="capsula-label">SEO Contato - descrição</label><input name="seo_contact_description" class="capsula-input" value="{{ old('seo_contact_description', $siteSettings['seo_contact_description']) }}"></div>
        </div>
        @if ($errors->any())<div class="rounded-3xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700">
            <ul class="space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>@endif
        <button class="capsula-button">Salvar configurações</button>
    </form>
</div>
@endsection