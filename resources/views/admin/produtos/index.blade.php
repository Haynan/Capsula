@extends('layouts.admin')
@section('title', 'Produtos')
@section('page-title', 'Produtos')
@section('content')
    <div class="capsula-card">
        <form method="GET" class="grid gap-4 lg:grid-cols-3">
            <input name="q" class="capsula-input" placeholder="Buscar produto" value="{{ request('q') }}">
            <button class="capsula-button">Filtrar</button>
            <a href="{{ route('admin.products.create') }}" class="capsula-button-secondary">Novo produto</a>
        </form>
        <div class="mt-6 overflow-x-auto">
            <table class="capsula-table">
                <thead><tr><th>Produto</th><th>Slug</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td><p class="font-semibold text-[var(--capsula-900)]">{{ $product->name }}</p><p class="text-xs text-[var(--capsula-500)]">{{ $product->short_description }}</p></td>
                            <td>{{ $product->slug }}</td>
                            <td>@if($product->is_active)<x-status-badge value="ativo" />@else<x-status-badge value="inativo" />@endif</td>
                            <td><a href="{{ route('admin.products.edit', $product) }}" class="text-sm font-semibold text-[var(--capsula-800)]">Editar</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Nenhum produto encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $products->links() }}</div>
    </div>
@endsection
