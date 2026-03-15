<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $seoTitle ?? $siteSettings['site_name'] }}</title>
        <meta name="description" content="{{ $seoDescription ?? $siteSettings['site_tagline'] }}">
        <meta property="og:title" content="{{ $seoTitle ?? $siteSettings['site_name'] }}">
        <meta property="og:description" content="{{ $seoDescription ?? $siteSettings['site_tagline'] }}">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ asset('brand/capsula-corretora.jpg') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header class="sticky top-0 z-40 border-b border-white/60 bg-white/85 backdrop-blur">
            <div class="capsula-container flex items-center justify-between py-4">
                <a href="{{ route('site.home') }}" class="flex items-center gap-3">
                    <x-application-logo class="h-12 w-12 rounded-full object-cover" />
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--capsula-500)]">Cápsula</p>
                        <p class="text-sm font-semibold text-[var(--capsula-900)]">{{ $siteSettings['site_name'] }}</p>
                    </div>
                </a>

                <nav class="hidden items-center gap-8 text-sm font-medium text-[var(--capsula-600)] md:flex">
                    <a href="{{ route('site.home') }}#sobre">Sobre</a>
                    <a href="{{ route('site.home') }}#produtos">Produtos</a>
                    <a href="{{ route('site.partners') }}">Parceiros</a>
                    <a href="{{ route('site.contact') }}">Contato</a>
                </nav>

                <a href="{{ route('site.home') }}#solicitar-proposta" class="capsula-button">Solicitar proposta</a>
            </div>
        </header>

        @if (session('status'))
            <div class="capsula-container pt-6">
                <x-flash-message />
            </div>
        @endif

        <main>
            @yield('content')
        </main>

        <footer class="mt-24 border-t border-white/60 bg-white/80">
            <div class="capsula-container grid gap-8 py-12 md:grid-cols-3">
                <div>
                    <p class="capsula-section-kicker">Cápsula Corretora</p>
                    <p class="mt-3 max-w-sm text-sm leading-7 text-[var(--capsula-500)]">{{ $siteSettings['site_tagline'] }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-[var(--capsula-900)]">Contato</p>
                    <ul class="mt-3 space-y-2 text-sm text-[var(--capsula-500)]">
                        <li>{{ $siteSettings['company_phone'] ?: 'Telefone a configurar' }}</li>
                        <li>{{ $siteSettings['company_whatsapp'] ?: 'WhatsApp a configurar' }}</li>
                        <li>{{ $siteSettings['company_email'] ?: 'E-mail a configurar' }}</li>
                    </ul>
                </div>
                <div>
                    <p class="text-sm font-semibold text-[var(--capsula-900)]">Institucional</p>
                    <div class="mt-3 flex flex-col gap-2 text-sm text-[var(--capsula-500)]">
                        <a href="{{ route('site.partners') }}">Parceiros</a>
                        <a href="{{ route('site.contact') }}">Contato</a>
                        <a href="{{ route('site.privacy') }}">Política de Privacidade</a>
                        <a href="{{ route('login') }}">Acesso administrativo</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
