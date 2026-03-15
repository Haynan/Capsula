@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <div class="capsula-card"><p class="text-sm text-[var(--capsula-500)]">Total de leads</p><p class="mt-3 text-4xl font-semibold">{{ $stats['totalLeads'] }}</p></div>
        <div class="capsula-card"><p class="text-sm text-[var(--capsula-500)]">Leads novos</p><p class="mt-3 text-4xl font-semibold">{{ $stats['newLeads'] }}</p></div>
        <div class="capsula-card"><p class="text-sm text-[var(--capsula-500)]">Oportunidades abertas</p><p class="mt-3 text-4xl font-semibold">{{ $stats['openOpportunities'] }}</p></div>
        <div class="capsula-card"><p class="text-sm text-[var(--capsula-500)]">Propostas pendentes</p><p class="mt-3 text-4xl font-semibold">{{ $stats['pendingProposals'] }}</p></div>
        <div class="capsula-card"><p class="text-sm text-[var(--capsula-500)]">Renovações próximas</p><p class="mt-3 text-4xl font-semibold">{{ $stats['upcomingRenewals'] }}</p></div>
        <div class="capsula-card"><p class="text-sm text-[var(--capsula-500)]">Clientes ativos</p><p class="mt-3 text-4xl font-semibold">{{ $stats['activeClients'] }}</p></div>
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-3">
        <div class="capsula-card xl:col-span-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold">Últimos leads</h2>
                <a href="{{ route('admin.leads.index') }}" class="text-sm font-semibold text-[var(--capsula-700)]">Ver todos</a>
            </div>
            <div class="mt-6 overflow-x-auto">
                <table class="capsula-table">
                    <thead><tr><th>Lead</th><th>Status</th><th>Produto</th><th>Data</th></tr></thead>
                    <tbody>
                        @forelse ($latestLeads as $lead)
                            <tr>
                                <td><a href="{{ route('admin.leads.show', $lead) }}" class="font-semibold text-[var(--capsula-900)]">{{ $lead->name }}</a><div class="text-xs text-[var(--capsula-500)]">{{ $lead->email }}</div></td>
                                <td><x-status-badge :value="$lead->status->value" /></td>
                                <td>{{ $lead->product?->name ?: '-' }}</td>
                                <td>{{ $lead->created_at?->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">Nenhum lead registrado.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="capsula-card">
                <h2 class="text-xl font-semibold">Próximas renovações</h2>
                <div class="mt-5 space-y-4">
                    @forelse ($nextRenewals as $renewal)
                        <a href="{{ route('admin.renewals.show', $renewal) }}" class="block rounded-3xl border border-[var(--capsula-100)] bg-[var(--capsula-50)] px-4 py-4">
                            <p class="font-semibold text-[var(--capsula-900)]">{{ $renewal->client->name }}</p>
                            <p class="mt-1 text-sm text-[var(--capsula-500)]">{{ $renewal->product->name }} • {{ $renewal->due_date?->format('d/m/Y') }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-[var(--capsula-500)]">Nenhuma renovação próxima.</p>
                    @endforelse
                </div>
            </div>

            <div class="capsula-card">
                <h2 class="text-xl font-semibold">Atividades recentes</h2>
                <div class="mt-5 space-y-4">
                    @forelse ($recentNotes as $note)
                        <div class="rounded-3xl border border-[var(--capsula-100)] bg-[var(--capsula-50)] px-4 py-4">
                            <p class="text-sm font-semibold text-[var(--capsula-900)]">{{ $note->user->name }}</p>
                            <p class="mt-2 text-sm leading-7 text-[var(--capsula-500)]">{{ Str::limit($note->content, 120) }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-[var(--capsula-500)]">Nenhuma atividade registrada.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
