@extends('layouts.admin')
@section('title', $proposal->title)
@section('page-title', 'Proposta: '.$proposal->title)
@section('content')
    <div class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
        <div class="space-y-6">
            <div class="capsula-card">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <x-status-badge :value="$proposal->status->value" />
                        <p class="mt-4 text-sm text-[var(--capsula-500)]">{{ $proposal->opportunity->title }} • {{ $proposal->partner?->name ?: 'Sem parceiro' }}</p>
                    </div>
                    <a href="{{ route('admin.proposals.edit', $proposal) }}" class="capsula-button-secondary">Editar</a>
                </div>
                <dl class="mt-6 grid gap-5 md:grid-cols-2">
                    <div><dt class="capsula-label">Cliente</dt><dd class="mt-2 text-sm">{{ $proposal->opportunity->client?->name ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Lead</dt><dd class="mt-2 text-sm">{{ $proposal->opportunity->lead?->name ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Valor</dt><dd class="mt-2 text-sm">{{ $proposal->amount ? 'R$ '.number_format((float) $proposal->amount, 2, ',', '.') : '-' }}</dd></div>
                    <div><dt class="capsula-label">Validade</dt><dd class="mt-2 text-sm">{{ $proposal->valid_until?->format('d/m/Y') ?: '-' }}</dd></div>
                </dl>
                <div class="mt-6"><p class="capsula-label">Detalhes</p><p class="mt-2 whitespace-pre-line text-sm leading-7 text-[var(--capsula-600)]">{{ $proposal->details ?: 'Sem detalhes registrados.' }}</p></div>
            </div>

            <div class="capsula-card">
                <h2 class="text-xl font-semibold">Marcar como aceita</h2>
                @if(!$proposal->opportunity->client)
                    <p class="mt-4 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">Esta oportunidade ainda não possui cliente vinculado. O aceite pode ser registrado, mas o histórico e a renovação dependem de um cliente.</p>
                @endif
                <form method="POST" action="{{ route('admin.proposals.accept', $proposal) }}" class="mt-6 grid gap-5 md:grid-cols-2">
                    @csrf
                    <label class="flex items-center gap-3 rounded-2xl border border-[var(--capsula-200)] bg-[var(--capsula-50)] px-4 py-3 text-sm md:col-span-2"><input type="checkbox" name="create_client_service" value="1" class="rounded border-[var(--capsula-300)]"> Criar ou atualizar histórico simplificado do cliente</label>
                    <div><label class="capsula-label">Histórico existente (opcional)</label><select name="client_service_id" class="capsula-select"><option value="">Criar novo histórico</option>@foreach($clientServices as $service)<option value="{{ $service->id }}">{{ $service->title }}</option>@endforeach</select></div>
                    <div><label class="capsula-label">Parceiro</label><select name="partner_id" class="capsula-select"><option value="">Manter parceiro da proposta</option>@foreach($partners as $partner)<option value="{{ $partner->id }}" @selected($proposal->partner_id === $partner->id)>{{ $partner->name }}</option>@endforeach</select></div>
                    <div class="md:col-span-2"><label class="capsula-label">Título do histórico</label><input name="service_title" class="capsula-input" value="{{ $proposal->title }}"></div>
                    <div><label class="capsula-label">Início</label><input name="service_start_date" type="date" class="capsula-input" value="{{ now()->format('Y-m-d') }}"></div>
                    <div><label class="capsula-label">Data de renovação</label><input name="service_renewal_date" type="date" class="capsula-input"></div>
                    <div class="md:col-span-2"><label class="capsula-label">Descrição</label><textarea name="service_description" class="capsula-textarea">{{ $proposal->details }}</textarea></div>
                    <label class="flex items-center gap-3 rounded-2xl border border-[var(--capsula-200)] bg-[var(--capsula-50)] px-4 py-3 text-sm md:col-span-2"><input type="checkbox" name="create_renewal" value="1" class="rounded border-[var(--capsula-300)]"> Criar renovação vinculada</label>
                    <div><label class="capsula-label">Vencimento da renovação</label><input name="renewal_due_date" type="date" class="capsula-input"></div>
                    <div><label class="capsula-label">Status da renovação</label><select name="renewal_status" class="capsula-select"><option value="pendente">Pendente</option><option value="em_contato">Em contato</option></select></div>
                    <div class="md:col-span-2"><label class="capsula-label">Observações da renovação</label><textarea name="renewal_notes" class="capsula-textarea"></textarea></div>
                    <div class="md:col-span-2"><button class="capsula-button">Confirmar aceite</button></div>
                </form>
            </div>

            @include('admin.partials.notes', ['noteable' => $proposal, 'noteType' => 'proposal'])
        </div>
        <div class="capsula-card">
            <h2 class="text-xl font-semibold">Oportunidade relacionada</h2>
            <div class="mt-5 rounded-3xl border border-[var(--capsula-100)] bg-[var(--capsula-50)] px-4 py-4">
                <p class="font-semibold text-[var(--capsula-900)]">{{ $proposal->opportunity->title }}</p>
                <p class="mt-2 text-sm text-[var(--capsula-500)]">{{ $proposal->opportunity->product?->name ?: '-' }}</p>
                <a href="{{ route('admin.opportunities.show', $proposal->opportunity) }}" class="mt-4 inline-flex text-sm font-semibold text-[var(--capsula-800)]">Abrir oportunidade</a>
            </div>
        </div>
    </div>
@endsection
