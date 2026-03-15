@csrf
@if(isset($method) && $method === 'PUT')
    @method('PUT')
@endif
<div class="grid gap-6 md:grid-cols-2">
    <div><label class="capsula-label">Cliente</label><select name="client_id" class="capsula-select">@foreach($clients as $client)<option value="{{ $client->id }}" @selected(old('client_id', $renewal->client_id) == $client->id)>{{ $client->name }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Histórico</label><select name="client_service_id" class="capsula-select"><option value="">Selecione</option>@foreach($clientServices as $service)<option value="{{ $service->id }}" @selected(old('client_service_id', $renewal->client_service_id) == $service->id)>{{ $service->title }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Produto</label><select name="product_id" class="capsula-select">@foreach($products as $product)<option value="{{ $product->id }}" @selected(old('product_id', $renewal->product_id) == $product->id)>{{ $product->name }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Parceiro</label><select name="partner_id" class="capsula-select"><option value="">Selecione</option>@foreach($partners as $partner)<option value="{{ $partner->id }}" @selected(old('partner_id', $renewal->partner_id) == $partner->id)>{{ $partner->name }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Vencimento</label><input name="due_date" type="date" class="capsula-input" value="{{ old('due_date', $renewal->due_date?->format('Y-m-d')) }}"></div>
    <div><label class="capsula-label">Status</label><select name="status" class="capsula-select">@foreach($statuses as $status)<option value="{{ $status->value }}" @selected(old('status', $renewal->status?->value ?? $renewal->status) == $status->value)>{{ $status->label() }}</option>@endforeach</select></div>
</div>
<div class="mt-6"><label class="capsula-label">Observações</label><textarea name="notes" class="capsula-textarea">{{ old('notes', $renewal->notes) }}</textarea></div>
@if ($errors->any())<div class="mt-4 rounded-3xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700"><ul class="space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="mt-6 flex gap-3"><button class="capsula-button">{{ $submitLabel }}</button><a href="{{ route('admin.renewals.index') }}" class="capsula-button-secondary">Cancelar</a></div>
