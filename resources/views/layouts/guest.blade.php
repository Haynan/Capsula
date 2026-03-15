<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="flex min-h-screen items-center justify-center px-6 py-10">
            <div class="w-full max-w-md">
                <div class="mb-8 text-center">
                    <a href="{{ route('site.home') }}" class="inline-flex flex-col items-center gap-3">
                        <x-application-logo class="h-20 w-20 rounded-full object-cover shadow-lg" />
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--capsula-500)]">Painel administrativo</p>
                            <p class="mt-2 text-sm text-[var(--capsula-500)]">Acesso interno da Cápsula Corretora</p>
                        </div>
                    </a>
                </div>

                <div class="capsula-glass p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
