<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Painel') | {{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="capsula-admin-shell">
        <div class="flex min-h-screen flex-col lg:flex-row">
            <aside class="border-b border-white/60 bg-[var(--capsula-900)] px-6 py-6 text-white lg:min-h-screen lg:w-72 lg:border-b-0 lg:border-r lg:px-5">
                <div class="flex items-center gap-3">
                    <x-application-logo class="h-12 w-12 rounded-full object-cover" />
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-white/50">Painel</p>
                        <p class="text-sm font-semibold">{{ config('app.name') }}</p>
                    </div>
                </div>

                <nav class="mt-8 grid gap-2">
                    @include('admin.partials.sidebar')
                </nav>
            </aside>

            <div class="flex-1">
                <header class="border-b border-white/60 bg-white/80 px-6 py-4 backdrop-blur lg:px-10">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-[var(--capsula-400)]">@yield('eyebrow', 'Painel administrativo')</p>
                            <h1 class="mt-2 text-2xl font-semibold text-[var(--capsula-900)]">@yield('page-title', 'Dashboard')</h1>
                        </div>
                        <div class="text-right text-sm text-[var(--capsula-500)]">
                            <p>{{ auth()->user()->name }}</p>
                            <form method="POST" action="{{ route('logout') }}" class="mt-1">
                                @csrf
                                <button type="submit" class="font-semibold text-[var(--capsula-700)]">Sair</button>
                            </form>
                        </div>
                    </div>
                </header>

                <div class="px-6 py-8 lg:px-10">
                    @if (session('status'))
                        <div class="mb-6">
                            <x-flash-message />
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>
