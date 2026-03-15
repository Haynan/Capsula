<form method="POST" action="{{ route('site.proposals.store') }}" class="space-y-5">
    @csrf
    <input type="hidden" name="origin_page" value="{{ request()->path() }}">
    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="capsula-label" for="name">Nome</label>
            <input id="name" name="name" type="text" class="capsula-input" value="{{ old('name') }}" required>
            @error('name') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="capsula-label" for="email">E-mail</label>
            <input id="email" name="email" type="email" class="capsula-input" value="{{ old('email') }}" required>
            @error('email') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="capsula-label" for="phone">Telefone</label>
            <input id="phone" name="phone" type="text" class="capsula-input" value="{{ old('phone') }}" required>
            @error('phone') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="capsula-label" for="whatsapp">WhatsApp</label>
            <input id="whatsapp" name="whatsapp" type="text" class="capsula-input" value="{{ old('whatsapp') }}">
            @error('whatsapp') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="capsula-label" for="city">Cidade</label>
            <input id="city" name="city" type="text" class="capsula-input" value="{{ old('city') }}">
            @error('city') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="capsula-label" for="state">Estado</label>
            <input id="state" name="state" type="text" maxlength="2" class="capsula-input" value="{{ old('state') }}">
            @error('state') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label class="capsula-label" for="product_id">Produto de interesse</label>
        <select id="product_id" name="product_id" class="capsula-select" required>
            <option value="">Selecione</option>
            @foreach ($siteProducts as $product)
                <option value="{{ $product->id }}" @selected(old('product_id', $selectedProductId ?? null) == $product->id)>{{ $product->name }}</option>
            @endforeach
        </select>
        @error('product_id') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="capsula-label" for="message">Mensagem</label>
        <textarea id="message" name="message" class="capsula-textarea" required>{{ old('message') }}</textarea>
        @error('message') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>

    <label class="flex items-start gap-3 rounded-2xl border border-[var(--capsula-200)] bg-white/80 px-4 py-3 text-sm text-[var(--capsula-600)]">
        <input type="checkbox" name="consent" value="1" class="mt-1 rounded border-[var(--capsula-300)] text-[var(--capsula-900)] focus:ring-[var(--capsula-500)]" @checked(old('consent'))>
        <span>Autorizo o uso dos meus dados para contato comercial e tratamento desta solicitação, conforme a Política de Privacidade.</span>
    </label>
    @error('consent') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror

    <button type="submit" class="capsula-button w-full md:w-auto">Enviar solicitação</button>
</form>
