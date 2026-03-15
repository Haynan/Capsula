@extends('layouts.admin')
@section('title', $opportunity->title)
@section('page-title', 'Oportunidade: '.$opportunity->title)
@section('content')
    <div class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
        <div class="space-y-6">
            <div class="capsula-card">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <x-status-badge :value="$opportunity->status->value" />
                        <p class="mt-4 text-sm text-[var(--capsula-500)]">{{ $opportunity->product?->name ?: '-' }}</p>
                    </div>
                    <a href="{{ route('admin.opportunities.edit', $opportunity) }}" class="capsula-button-secondary">Editar</a>
                </div>
                <dl class="mt-6 grid gap-5 md:grid-cols-2">
                    <div><dt class="capsula-label">Lead</dt><dd class="mt-2 text-sm">{{ $opportunity->lead?->name ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Cliente</dt><dd class="mt-2 text-sm">{{ $opportunity->client?->name ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Valor estimado</dt><dd class="mt-2 text-sm">{{ $opportunity->estimated_value ? 'R$ '.number_format((float) $opportunity->estimated_value, 2, ',', '.') : '-' }}</dd></div>
                    <div><dt class="capsula-label">Fechamento previsto</dt><dd class="mt-2 text-sm">{{ $opportunity->expected_close_date?->format('d/m/Y') ?: '-' }}</dd></div>
                    <div class="md:col-span-2"><dt class="capsula-label">Próxima ação</dt><dd class="mt-2 text-sm">{{ $opportunity->next_action_at?->format('d/m/Y H:i') ?: '-' }}</dd></div>
                </dl>
                <div class="mt-6"><p class="capsula-label">Observações</p><p class="mt-2 whitespace-pre-line text-sm leading-7 text-[var(--capsula-600)]">{{ $opportunity->notes ?: 'Sem observações.' }}</p></div>
            </div>
            @include('admin.partials.notes', ['noteable' => $opportunity, 'noteType' => 'opportunity'])
        </div>
        <div class="capsula-card">
            <div class="flex items-center justify-between"><h2 class="text-xl font-semibold">Propostas vinculadas</h2><a href="{{ route('admin.proposals.create', ['opportunity_id' => $opportunity->id]) }}" class="capsula-button-secondary">Nova proposta</a></div>
            <div class="mt-5 space-y-4">
                @forelse($opportunity->proposals as $proposal)
                    <a href="{{ route('admin.proposals.show', $proposal) }}" class="block rounded-3xl border border-[var(--capsula-100)] bg-[var(--capsula-50)] px-4 py-4">
                        <div class="flex items-center justify-between gap-4"><p class="font-semibold text-[var(--capsula-900)]">{{ $proposal->title }}</p><x-status-badge :value="$proposal->status->value" /></div>
                        <p class="mt-1 text-sm text-[var(--capsula-500)]">{{ $proposal->partner?->name ?: 'Sem parceiro' }}</p>
                    </a>
                @empty
                    <p class="text-sm text-[var(--capsula-500)]">Nenhuma proposta registrada.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
