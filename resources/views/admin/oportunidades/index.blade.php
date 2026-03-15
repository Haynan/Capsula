@extends('layouts.admin')
@section('title', 'Oportunidades')
@section('page-title', 'Oportunidades')
@section('content')
    <div class="capsula-card">
        <form method="GET" class="grid gap-4 lg:grid-cols-4">
            <input name="q" class="capsula-input" placeholder="Buscar por título" value="{{ request('q') }}">
            <select name="status" class="capsula-select"><option value="">Todos os status</option>@foreach($statuses as $status)<option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>@endforeach</select>
            <select name="product_id" class="capsula-select"><option value="">Todos os produtos</option>@foreach($products as $product)<option value="{{ $product->id }}" @selected((int) request('product_id') === $product->id)>{{ $product->name }}</option>@endforeach</select>
            <div class="flex gap-3"><button class="capsula-button w-full">Filtrar</button><a href="{{ route('admin.opportunities.create') }}" class="capsula-button-secondary w-full">Nova</a></div>
        </form>
        <div class="mt-6 overflow-x-auto">
            <table class="capsula-table">
                <thead><tr><th>Título</th><th>Produto</th><th>Status</th><th>Lead/Cliente</th><th></th></tr></thead>
                <tbody>
                    @forelse($opportunities as $opportunity)
                        <tr>
                            <td><p class="font-semibold text-[var(--capsula-900)]">{{ $opportunity->title }}</p><p class="text-xs text-[var(--capsula-500)]">{{ $opportunity->expected_close_date?->format('d/m/Y') ?: 'Sem previsão' }}</p></td>
                            <td>{{ $opportunity->product?->name ?: '-' }}</td>
                            <td><x-status-badge :value="$opportunity->status->value" /></td>
                            <td>{{ $opportunity->client?->name ?: ($opportunity->lead?->name ?: '-') }}</td>
                            <td><a href="{{ route('admin.opportunities.show', $opportunity) }}" class="text-sm font-semibold text-[var(--capsula-800)]">Abrir</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Nenhuma oportunidade encontrada.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $opportunities->links() }}</div>
    </div>
@endsection
