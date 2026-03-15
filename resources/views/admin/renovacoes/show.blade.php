@extends('layouts.admin')
@section('title', 'Renovação')
@section('page-title', 'Renovação')
@section('content')
    <div class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
        <div class="space-y-6">
            <div class="capsula-card">
                <div class="flex items-start justify-between gap-4">
                    <div><x-status-badge :value="$renewal->status->value" /></div>
                    <a href="{{ route('admin.renewals.edit', $renewal) }}" class="capsula-button-secondary">Editar</a>
                </div>
                <dl class="mt-6 grid gap-5 md:grid-cols-2">
                    <div><dt class="capsula-label">Cliente</dt><dd class="mt-2 text-sm">{{ $renewal->client?->name ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Histórico</dt><dd class="mt-2 text-sm">{{ $renewal->clientService?->title ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Produto</dt><dd class="mt-2 text-sm">{{ $renewal->product?->name ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Parceiro</dt><dd class="mt-2 text-sm">{{ $renewal->partner?->name ?: '-' }}</dd></div>
                    <div class="md:col-span-2"><dt class="capsula-label">Vencimento</dt><dd class="mt-2 text-sm">{{ $renewal->due_date?->format('d/m/Y') ?: '-' }}</dd></div>
                </dl>
                <div class="mt-6"><p class="capsula-label">Observações</p><p class="mt-2 whitespace-pre-line text-sm leading-7 text-[var(--capsula-600)]">{{ $renewal->notes ?: 'Sem observações.' }}</p></div>
            </div>
            @include('admin.partials.notes', ['noteable' => $renewal, 'noteType' => 'renewal'])
        </div>
    </div>
@endsection
