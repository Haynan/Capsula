@csrf
@if(isset($method) && $method === 'PUT')
    @method('PUT')
@endif
<div class="grid gap-6 md:grid-cols-2">
    <div class="md:col-span-2"><label class="capsula-label">Oportunidade</label><select name="opportunity_id" class="capsula-select">@foreach($opportunities as $opportunityItem)<option value="{{ $opportunityItem->id }}" @selected(old('opportunity_id', request('opportunity_id', $proposal->opportunity_id)) == $opportunityItem->id)>{{ $opportunityItem->title }}{{ $opportunityItem->client ? ' - '.$opportunityItem->client->name : '' }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Parceiro</label><select name="partner_id" class="capsula-select"><option value="">Selecione</option>@foreach($partners as $partner)<option value="{{ $partner->id }}" @selected(old('partner_id', $proposal->partner_id) == $partner->id)>{{ $partner->name }}</option>@endforeach</select></div>
    <div><label class="capsula-label">Status</label><select name="status" class="capsula-select">@foreach($statuses as $status)<option value="{{ $status->value }}" @selected(old('status', $proposal->status?->value ?? $proposal->status) == $status->value)>{{ $status->label() }}</option>@endforeach</select></div>
    <div class="md:col-span-2"><label class="capsula-label">Título</label><input name="title" class="capsula-input" value="{{ old('title', $proposal->title) }}" required></div>
    <div><label class="capsula-label">Valor</label><input name="amount" type="number" step="0.01" class="capsula-input" value="{{ old('amount', $proposal->amount) }}"></div>
    <div><label class="capsula-label">Parcelas</label><input name="installments" class="capsula-input" value="{{ old('installments', $proposal->installments) }}"></div>
    <div class="md:col-span-2"><label class="capsula-label">Validade</label><input name="valid_until" type="date" class="capsula-input" value="{{ old('valid_until', $proposal->valid_until?->format('Y-m-d')) }}"></div>
</div>
<div class="mt-6"><label class="capsula-label">Detalhes</label><textarea name="details" class="capsula-textarea">{{ old('details', $proposal->details) }}</textarea></div>
@if ($errors->any())<div class="mt-4 rounded-3xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700"><ul class="space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="mt-6 flex gap-3"><button class="capsula-button">{{ $submitLabel }}</button><a href="{{ route('admin.proposals.index') }}" class="capsula-button-secondary">Cancelar</a></div>
