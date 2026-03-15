@extends('layouts.admin')

@section('title', 'Leads')
@section('page-title', 'Leads')

@section('content')
    <div class="capsula-card">
        <form method="GET" class="grid gap-4 lg:grid-cols-5">
            <input name="q" class="capsula-input" placeholder="Buscar por nome, e-mail ou telefone" value="{{ request('q') }}">
            <select name="status" class="capsula-select"><option value="">Todos os status</option>@foreach($statuses as $status)<option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>@endforeach</select>
            <select name="priority" class="capsula-select"><option value="">Todas as prioridades</option>@foreach($priorities as $priority)<option value="{{ $priority->value }}" @selected(request('priority') === $priority->value)>{{ $priority->label() }}</option>@endforeach</select>
            <select name="product_id" class="capsula-select"><option value="">Todos os produtos</option>@foreach($products as $product)<option value="{{ $product->id }}" @selected((int) request('product_id') === $product->id)>{{ $product->name }}</option>@endforeach</select>
            <div class="flex gap-3"><button class="capsula-button w-full">Filtrar</button><a href="{{ route('admin.leads.create') }}" class="capsula-button-secondary w-full">Novo lead</a></div>
        </form>

        <div class="mt-6 overflow-x-auto">
            <table class="capsula-table">
                <thead><tr><th>Lead</th><th>Produto</th><th>Status</th><th>Prioridade</th><th>Criado em</th><th></th></tr></thead>
                <tbody>
                    @forelse ($leads as $lead)
                        <tr>
                            <td><p class="font-semibold text-[var(--capsula-900)]">{{ $lead->name }}</p><p class="text-xs text-[var(--capsula-500)]">{{ $lead->email }} • {{ $lead->phone }}</p></td>
                            <td>{{ $lead->product?->name ?: '-' }}</td>
                            <td><x-status-badge :value="$lead->status->value" /></td>
                            <td><x-status-badge :value="$lead->priority->value" /></td>
                            <td>{{ $lead->created_at?->format('d/m/Y H:i') }}</td>
                            <td><a href="{{ route('admin.leads.show', $lead) }}" class="text-sm font-semibold text-[var(--capsula-800)]">Abrir</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Nenhum lead encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $leads->links() }}</div>
    </div>
@endsection
