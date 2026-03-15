@extends('layouts.admin')
@section('title', 'Renovações')
@section('page-title', 'Renovações')
@section('content')
    <div class="capsula-card">
        <form method="GET" class="grid gap-4 lg:grid-cols-4">
            <select name="status" class="capsula-select"><option value="">Todos os status</option>@foreach($statuses as $status)<option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>@endforeach</select>
            <input type="date" name="due_until" class="capsula-input" value="{{ request('due_until') }}">
            <button class="capsula-button">Filtrar</button>
            <a href="{{ route('admin.renewals.create') }}" class="capsula-button-secondary">Nova renovação</a>
        </form>
        <div class="mt-6 overflow-x-auto">
            <table class="capsula-table">
                <thead><tr><th>Cliente</th><th>Produto</th><th>Vencimento</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse($renewals as $renewal)
                        <tr>
                            <td class="font-semibold text-[var(--capsula-900)]">{{ $renewal->client?->name ?: '-' }}</td>
                            <td>{{ $renewal->product?->name ?: '-' }}</td>
                            <td>{{ $renewal->due_date?->format('d/m/Y') }}</td>
                            <td><x-status-badge :value="$renewal->status->value" /></td>
                            <td><a href="{{ route('admin.renewals.show', $renewal) }}" class="text-sm font-semibold text-[var(--capsula-800)]">Abrir</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Nenhuma renovação encontrada.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $renewals->links() }}</div>
    </div>
@endsection
