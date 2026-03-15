@csrf
@if(isset($method) && $method === 'PUT')
    @method('PUT')
@endif

<div class="grid gap-6 md:grid-cols-2">
    <div><label class="capsula-label">Tipo</label><select name="type" class="capsula-select">@foreach($types as $type)<option value="{{ $type->value }}" @selected(old('type', $client->type?->value ?? $client->type) == $type->value)>{{ $type->label() }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Nome</label><input name="name" class="capsula-input" value="{{ old('name', $client->name) }}" required></div>
    <div><label class="capsula-label">Documento</label><input name="document" class="capsula-input" value="{{ old('document', $client->document) }}"></div>
    <div><label class="capsula-label">E-mail</label><input name="email" type="email" class="capsula-input" value="{{ old('email', $client->email) }}"></div>
    <div><label class="capsula-label">Telefone</label><input name="phone" class="capsula-input" value="{{ old('phone', $client->phone) }}"></div>
    <div><label class="capsula-label">WhatsApp</label><input name="whatsapp" class="capsula-input" value="{{ old('whatsapp', $client->whatsapp) }}"></div>
    <div><label class="capsula-label">Cidade</label><input name="city" class="capsula-input" value="{{ old('city', $client->city) }}"></div>
    <div><label class="capsula-label">Estado</label><input name="state" maxlength="2" class="capsula-input" value="{{ old('state', $client->state) }}"></div>
</div>
<div class="mt-6"><label class="capsula-label">Endereço</label><input name="address" class="capsula-input" value="{{ old('address', $client->address) }}"></div>
<div class="mt-6"><label class="capsula-label">Resumo de observações</label><textarea name="notes_summary" class="capsula-textarea">{{ old('notes_summary', $client->notes_summary) }}</textarea></div>

@if ($errors->any())
    <div class="mt-4 rounded-3xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700">
        <ul class="space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<div class="mt-6 flex gap-3">
    <button class="capsula-button" type="submit">{{ $submitLabel }}</button>
    <a href="{{ route('admin.clients.index') }}" class="capsula-button-secondary">Cancelar</a>
</div>
