@csrf
@if(isset($method) && $method === 'PUT')
    @method('PUT')
@endif

<div class="grid gap-6 md:grid-cols-2">
    <div><label class="capsula-label">Nome</label><input name="name" class="capsula-input" value="{{ old('name', $lead->name) }}" required></div>
    <div><label class="capsula-label">E-mail</label><input name="email" type="email" class="capsula-input" value="{{ old('email', $lead->email) }}" required></div>
    <div><label class="capsula-label">Telefone</label><input name="phone" class="capsula-input" value="{{ old('phone', $lead->phone) }}" required></div>
    <div><label class="capsula-label">WhatsApp</label><input name="whatsapp" class="capsula-input" value="{{ old('whatsapp', $lead->whatsapp) }}"></div>
    <div><label class="capsula-label">Cidade</label><input name="city" class="capsula-input" value="{{ old('city', $lead->city) }}"></div>
    <div><label class="capsula-label">Estado</label><input name="state" maxlength="2" class="capsula-input" value="{{ old('state', $lead->state) }}"></div>
    <div><label class="capsula-label">Produto</label><select name="product_id" class="capsula-select"><option value="">Selecione</option>@foreach($products as $product)<option value="{{ $product->id }}" @selected(old('product_id', $lead->product_id) == $product->id)>{{ $product->name }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Origem</label><input name="source" class="capsula-input" value="{{ old('source', $lead->source ?: 'manual') }}"></div>
    <div><label class="capsula-label">Status</label><select name="status" class="capsula-select">@foreach($statuses as $status)<option value="{{ $status->value }}" @selected(old('status', $lead->status?->value ?? $lead->status) == $status->value)>{{ $status->label() }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Prioridade</label><select name="priority" class="capsula-select">@foreach($priorities as $priority)<option value="{{ $priority->value }}" @selected(old('priority', $lead->priority?->value ?? $lead->priority) == $priority->value)>{{ $priority->label() }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Contato realizado em</label><input name="contacted_at" type="datetime-local" class="capsula-input" value="{{ old('contacted_at', $lead->contacted_at?->format('Y-m-d\\TH:i')) }}"></div>
    <div><label class="capsula-label">Consentimento em</label><input name="consent_at" type="datetime-local" class="capsula-input" value="{{ old('consent_at', $lead->consent_at?->format('Y-m-d\\TH:i') ?? now()->format('Y-m-d\\TH:i')) }}"></div>
</div>
<div class="mt-6"><label class="capsula-label">Mensagem</label><textarea name="message" class="capsula-textarea">{{ old('message', $lead->message) }}</textarea></div>

@if ($errors->any())
    <div class="mt-4 rounded-3xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700">
        <ul class="space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<div class="mt-6 flex gap-3">
    <button class="capsula-button" type="submit">{{ $submitLabel }}</button>
    <a href="{{ route('admin.leads.index') }}" class="capsula-button-secondary">Cancelar</a>
</div>
