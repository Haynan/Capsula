@extends('layouts.admin')
@section('title', 'Parceiros')
@section('page-title', 'Parceiros')
@section('content')
    <div class="capsula-card">
        <form method="GET" class="grid gap-4 lg:grid-cols-3">
            <input name="q" class="capsula-input" placeholder="Buscar parceiro" value="{{ request('q') }}">
            <button class="capsula-button">Filtrar</button>
            <a href="{{ route('admin.partners.create') }}" class="capsula-button-secondary">Novo parceiro</a>
        </form>
        <div class="mt-6 overflow-x-auto">
            <table class="capsula-table">
                <thead><tr><th>Parceiro</th><th>Slug</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse($partners as $partner)
                        <tr>
                            <td><div class="flex items-center gap-3">@if($partner->logo_path)<img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="h-10 w-14 rounded-xl object-contain bg-[var(--capsula-50)] p-2">@endif<div><p class="font-semibold text-[var(--capsula-900)]">{{ $partner->name }}</p><p class="text-xs text-[var(--capsula-500)]">{{ $partner->website_url ?: '-' }}</p></div></div></td>
                            <td>{{ $partner->slug }}</td>
                            <td>@if($partner->is_active)<x-status-badge value="ativo" />@else<x-status-badge value="inativo" />@endif</td>
                            <td><a href="{{ route('admin.partners.edit', $partner) }}" class="text-sm font-semibold text-[var(--capsula-800)]">Editar</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Nenhum parceiro encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $partners->links() }}</div>
    </div>
@endsection
