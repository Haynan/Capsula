@extends('layouts.admin')
@section('title', 'Propostas')
@section('page-title', 'Propostas')
@section('content')
    <div class="capsula-card">
        <form method="GET" class="grid gap-4 lg:grid-cols-4">
            <input name="q" class="capsula-input" placeholder="Buscar por título" value="{{ request('q') }}">
            <select name="status" class="capsula-select"><option value="">Todos os status</option>@foreach($statuses as $status)<option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>@endforeach</select>
            <select name="partner_id" class="capsula-select"><option value="">Todos os parceiros</option>@foreach($partners as $partner)<option value="{{ $partner->id }}" @selected((int) request('partner_id') === $partner->id)>{{ $partner->name }}</option>@endforeach</select>
            <div class="flex gap-3"><button class="capsula-button w-full">Filtrar</button><a href="{{ route('admin.proposals.create') }}" class="capsula-button-secondary w-full">Nova</a></div>
        </form>
        <div class="mt-6 overflow-x-auto">
            <table class="capsula-table">
                <thead><tr><th>Título</th><th>Parceiro</th><th>Status</th><th>Validade</th><th></th></tr></thead>
                <tbody>
                    @forelse($proposals as $proposal)
                        <tr>
                            <td><p class="font-semibold text-[var(--capsula-900)]">{{ $proposal->title }}</p><p class="text-xs text-[var(--capsula-500)]">{{ $proposal->opportunity?->client?->name ?: ($proposal->opportunity?->title ?: '-') }}</p></td>
                            <td>{{ $proposal->partner?->name ?: '-' }}</td>
                            <td><x-status-badge :value="$proposal->status->value" /></td>
                            <td>{{ $proposal->valid_until?->format('d/m/Y') ?: '-' }}</td>
                            <td><a href="{{ route('admin.proposals.show', $proposal) }}" class="text-sm font-semibold text-[var(--capsula-800)]">Abrir</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Nenhuma proposta encontrada.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $proposals->links() }}</div>
    </div>
@endsection
