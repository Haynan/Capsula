<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6">
        <p class="capsula-section-kicker">Acesso interno</p>
        <h1 class="mt-3 text-3xl font-semibold text-[var(--capsula-900)]">Entrar no painel</h1>
        <p class="mt-3 text-sm leading-7 text-[var(--capsula-500)]">Use suas credenciais de administrador para acessar leads, clientes e propostas da corretora.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="'E-mail'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="'Senha'" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-black shadow-sm focus:ring-gray-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Lembrar acesso</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" href="{{ route('password.request') }}">
                    Esqueceu sua senha?
                </a>
            @endif

            <x-primary-button class="ms-3">
                Entrar
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
