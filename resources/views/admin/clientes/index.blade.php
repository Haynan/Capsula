@extends('layouts.admin')

@section('title', 'Clientes')
@section('page-title', 'Clientes')

@section('content')
    <div class="capsula-card">
        <form method="GET" class="grid gap-4 lg:grid-cols-4">
            <input name="q" class="capsula-input" placeholder="Buscar por nome, e-mail ou documento" value="{{ request('q') }}">
            <select name="type" class="capsula-select"><option value="">Todos os tipos</option>@foreach($types as $type)<option value="{{ $type->value }}" @selected(request('type') === $type->value)>{{ $type->label() }}</option>@endforeach</select>
            <button class="capsula-button">Filtrar</button>
            <a href="{{ route('admin.clients.create') }}" class="capsula-button-secondary">Novo cliente</a>
        </form>

        <div class="mt-6 overflow-x-auto">
            <table class="capsula-table">
                <thead><tr><th>Cliente</th><th>Tipo</th><th>Contato</th><th>Cidade</th><th></th></tr></thead>
                <tbody>
                    @forelse ($clients as $client)
                        <tr>
                            <td class="font-semibold text-[var(--capsula-900)]">{{ $client->name }}</td>
                            <td><x-status-badge :value="$client->type->value" /></td>
                            <td>{{ $client->email ?: ($client->phone ?: '-') }}</td>
                            <td>{{ trim(($client->city ?: '').' / '.($client->state ?: ''), ' /') ?: '-' }}</td>
                            <td><a href="{{ route('admin.clients.show', $client) }}" class="text-sm font-semibold text-[var(--capsula-800)]">Abrir</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Nenhum cliente encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $clients->links() }}</div>
    </div>
@endsection
