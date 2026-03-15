@csrf
@if(isset($method) && $method === 'PUT')
    @method('PUT')
@endif

<div class="grid gap-6 md:grid-cols-2">
    <div><label class="capsula-label">Lead</label><select name="lead_id" class="capsula-select"><option value="">Selecione</option>@foreach($leads as $lead)<option value="{{ $lead->id }}" @selected(old('lead_id', $opportunity->lead_id) == $lead->id)>{{ $lead->name }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Cliente</label><select name="client_id" class="capsula-select"><option value="">Selecione</option>@foreach($clients as $client)<option value="{{ $client->id }}" @selected(old('client_id', $opportunity->client_id) == $client->id)>{{ $client->name }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Produto</label><select name="product_id" class="capsula-select" required>@foreach($products as $product)<option value="{{ $product->id }}" @selected(old('product_id', $opportunity->product_id) == $product->id)>{{ $product->name }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Status</label><select name="status" class="capsula-select">@foreach($statuses as $status)<option value="{{ $status->value }}" @selected(old('status', $opportunity->status?->value ?? $opportunity->status) == $status->value)>{{ $status->label() }}</option>@endforeach</select></div>
    <div class="md:col-span-2"><label class="capsula-label">Título</label><input name="title" class="capsula-input" value="{{ old('title', $opportunity->title) }}" required></div>
    <div><label class="capsula-label">Valor estimado</label><input name="estimated_value" type="number" step="0.01" class="capsula-input" value="{{ old('estimated_value', $opportunity->estimated_value) }}"></div>
    <div><label class="capsula-label">Previsão de fechamento</label><input name="expected_close_date" type="date" class="capsula-input" value="{{ old('expected_close_date', $opportunity->expected_close_date?->format('Y-m-d')) }}"></div>
    <div class="md:col-span-2"><label class="capsula-label">Próxima ação</label><input name="next_action_at" type="datetime-local" class="capsula-input" value="{{ old('next_action_at', $opportunity->next_action_at?->format('Y-m-d\\TH:i')) }}"></div>
</div>
<div class="mt-6"><label class="capsula-label">Observações</label><textarea name="notes" class="capsula-textarea">{{ old('notes', $opportunity->notes) }}</textarea></div>
@if ($errors->any())<div class="mt-4 rounded-3xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700"><ul class="space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="mt-6 flex gap-3"><button class="capsula-button">{{ $submitLabel }}</button><a href="{{ route('admin.opportunities.index') }}" class="capsula-button-secondary">Cancelar</a></div>
