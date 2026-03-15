@extends('layouts.admin')

@section('title', $client->name)
@section('page-title', 'Cliente: '.$client->name)

@section('content')
    <div class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
        <div class="space-y-6">
            <div class="capsula-card">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <x-status-badge :value="$client->type->value" />
                        <p class="mt-4 text-sm text-[var(--capsula-500)]">{{ $client->email ?: 'Sem e-mail' }} • {{ $client->phone ?: 'Sem telefone' }}</p>
                    </div>
                    <a href="{{ route('admin.clients.edit', $client) }}" class="capsula-button-secondary">Editar</a>
                </div>
                <dl class="mt-6 grid gap-5 md:grid-cols-2">
                    <div><dt class="capsula-label">Documento</dt><dd class="mt-2 text-sm">{{ $client->document ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">WhatsApp</dt><dd class="mt-2 text-sm">{{ $client->whatsapp ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Cidade/UF</dt><dd class="mt-2 text-sm">{{ trim(($client->city ?: '').' / '.($client->state ?: ''), ' /') ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Endereço</dt><dd class="mt-2 text-sm">{{ $client->address ?: '-' }}</dd></div>
                </dl>
                <div class="mt-6">
                    <p class="capsula-label">Resumo de observações</p>
                    <p class="mt-2 whitespace-pre-line text-sm leading-7 text-[var(--capsula-600)]">{{ $client->notes_summary ?: 'Sem observações.' }}</p>
                </div>
            </div>

            <div class="capsula-card">
                <h2 class="text-xl font-semibold">Histórico simplificado do cliente</h2>
                <div class="mt-6 overflow-x-auto">
                    <table class="capsula-table">
                        <thead><tr><th>Título</th><th>Produto</th><th>Parceiro</th><th>Renovação</th><th>Status</th></tr></thead>
                        <tbody>
                            @forelse($client->clientServices as $service)
                                <tr>
                                    <td><p class="font-semibold text-[var(--capsula-900)]">{{ $service->title }}</p><p class="text-xs text-[var(--capsula-500)]">{{ $service->start_date?->format('d/m/Y') ?: '-' }}</p></td>
                                    <td>{{ $service->product?->name ?: '-' }}</td>
                                    <td>{{ $service->partner?->name ?: '-' }}</td>
                                    <td>{{ $service->renewal_date?->format('d/m/Y') ?: '-' }}</td>
                                    <td><x-status-badge :value="$service->status->value" /></td>
                                </tr>
                            @empty
                                <tr><td colspan="5">Nenhum histórico registrado.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="capsula-card">
                <h2 class="text-xl font-semibold">Adicionar histórico manualmente</h2>
                <form method="POST" action="{{ route('admin.clients.services.store', $client) }}" class="mt-6 grid gap-5 md:grid-cols-2">
                    @csrf
                    <div><label class="capsula-label">Produto</label><select name="product_id" class="capsula-select" required><option value="">Selecione</option>@foreach($products as $product)<option value="{{ $product->id }}">{{ $product->name }}</option>@endforeach</select></div>
                    <div><label class="capsula-label">Parceiro</label><select name="partner_id" class="capsula-select"><option value="">Selecione</option>@foreach($partners as $partner)<option value="{{ $partner->id }}">{{ $partner->name }}</option>@endforeach</select></div>
                    <div class="md:col-span-2"><label class="capsula-label">Título</label><input name="title" class="capsula-input" required></div>
                    <div><label class="capsula-label">Início</label><input name="start_date" type="date" class="capsula-input"></div>
                    <div><label class="capsula-label">Renovação</label><input name="renewal_date" type="date" class="capsula-input"></div>
                    <div><label class="capsula-label">Status</label><select name="status" class="capsula-select">@foreach($serviceStatuses as $status)<option value="{{ $status->value }}">{{ $status->label() }}</option>@endforeach</select></div>
                    <div class="md:col-span-2"><label class="capsula-label">Descrição / notas</label><textarea name="description" class="capsula-textarea"></textarea></div>
                    <div class="md:col-span-2"><button class="capsula-button">Adicionar histórico</button></div>
                </form>
            </div>

            @include('admin.partials.notes', ['noteable' => $client, 'noteType' => 'client'])
        </div>

        <div class="space-y-6">
            <div class="capsula-card">
                <h2 class="text-xl font-semibold">Oportunidades</h2>
                <div class="mt-5 space-y-4">
                    @forelse($client->opportunities as $opportunity)
                        <a href="{{ route('admin.opportunities.show', $opportunity) }}" class="block rounded-3xl border border-[var(--capsula-100)] bg-[var(--capsula-50)] px-4 py-4">
                            <p class="font-semibold text-[var(--capsula-900)]">{{ $opportunity->title }}</p>
                            <p class="mt-1 text-sm text-[var(--capsula-500)]">{{ $opportunity->product?->name ?: '-' }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-[var(--capsula-500)]">Nenhuma oportunidade vinculada.</p>
                    @endforelse
                </div>
            </div>

            <div class="capsula-card">
                <h2 class="text-xl font-semibold">Renovações</h2>
                <div class="mt-5 space-y-4">
                    @forelse($client->renewals as $renewal)
                        <a href="{{ route('admin.renewals.show', $renewal) }}" class="block rounded-3xl border border-[var(--capsula-100)] bg-[var(--capsula-50)] px-4 py-4">
                            <p class="font-semibold text-[var(--capsula-900)]">{{ $renewal->product?->name ?: '-' }}</p>
                            <p class="mt-1 text-sm text-[var(--capsula-500)]">Vencimento em {{ $renewal->due_date?->format('d/m/Y') }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-[var(--capsula-500)]">Nenhuma renovação vinculada.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
