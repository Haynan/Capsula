@extends('layouts.site')

@section('content')
    <section class="capsula-container py-16">
        <div class="grid gap-8 lg:grid-cols-[0.7fr_1.3fr]">
            <div>
                <p class="capsula-section-kicker">Contato</p>
                <h1 class="mt-4 capsula-section-title">Fale com a Cápsula Corretora.</h1>
                <div class="mt-8 space-y-4 text-sm leading-7 text-[var(--capsula-500)]">
                    <p><strong class="text-[var(--capsula-900)]">Telefone:</strong> {{ $siteSettings['company_phone'] ?: 'A configurar' }}</p>
                    <p><strong class="text-[var(--capsula-900)]">WhatsApp:</strong> {{ $siteSettings['company_whatsapp'] ?: 'A configurar' }}</p>
                    <p><strong class="text-[var(--capsula-900)]">E-mail:</strong> {{ $siteSettings['company_email'] ?: 'A configurar' }}</p>
                    <p><strong class="text-[var(--capsula-900)]">Endereço:</strong> {{ $siteSettings['company_address'] ?: 'A configurar' }}</p>
                </div>
            </div>

            <div class="capsula-card">
                <p class="text-lg font-semibold text-[var(--capsula-900)]">Solicite retorno</p>
                <p class="mt-3 text-sm leading-7 text-[var(--capsula-500)]">Se preferir, envie seus dados pelo formulário e retornaremos com o encaminhamento comercial adequado.</p>
                <div class="mt-6">
                    @include('site.partials.lead-form')
                </div>
            </div>
        </div>
    </section>
@endsection
