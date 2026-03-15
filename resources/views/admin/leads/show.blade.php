@extends('layouts.admin')

@section('title', $lead->name)
@section('page-title', 'Lead: '.$lead->name)

@section('content')
    <div class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
        <div class="space-y-6">
            <div class="capsula-card">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-[var(--capsula-500)]">{{ $lead->email }} • {{ $lead->phone }}</p>
                        <div class="mt-3 flex gap-2">
                            <x-status-badge :value="$lead->status->value" />
                            <x-status-badge :value="$lead->priority->value" />
                        </div>
                    </div>
                    <a href="{{ route('admin.leads.edit', $lead) }}" class="capsula-button-secondary">Editar</a>
                </div>

                <dl class="mt-6 grid gap-5 md:grid-cols-2">
                    <div><dt class="capsula-label">WhatsApp</dt><dd class="mt-2 text-sm">{{ $lead->whatsapp ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Produto</dt><dd class="mt-2 text-sm">{{ $lead->product?->name ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Cidade/UF</dt><dd class="mt-2 text-sm">{{ trim(($lead->city ?: '').' / '.($lead->state ?: ''), ' /') ?: '-' }}</dd></div>
                    <div><dt class="capsula-label">Origem</dt><dd class="mt-2 text-sm">{{ $lead->source }}</dd></div>
                </dl>

                <div class="mt-6">
                    <p class="capsula-label">Mensagem</p>
                    <p class="mt-2 whitespace-pre-line text-sm leading-7 text-[var(--capsula-600)]">{{ $lead->message ?: 'Sem mensagem cadastrada.' }}</p>
                </div>
            </div>

            <div class="capsula-card">
                <h2 class="text-xl font-semibold">Converter lead</h2>
                <form method="POST" action="{{ route('admin.leads.convert', $lead) }}" class="mt-6 grid gap-5 md:grid-cols-2">
                    @csrf
                    <div>
                        <label class="capsula-label">Tipo do cliente</label>
                        <select name="type" class="capsula-select">
                            <option value="PF">Pessoa física</option>
                            <option value="PJ">Pessoa jurídica</option>
                        </select>
                    </div>
                    <label class="flex items-center gap-3 rounded-2xl border border-[var(--capsula-200)] bg-[var(--capsula-50)] px-4 py-3 text-sm">
                        <input type="checkbox" name="create_opportunity" value="1" class="rounded border-[var(--capsula-300)]">
                        Criar oportunidade junto com a conversão
                    </label>
                    <div>
                        <label class="capsula-label">Produto da oportunidade</label>
                        <select name="product_id" class="capsula-select">
                            <option value="">Selecione</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="capsula-label">Título</label><input name="title" class="capsula-input" value="Oportunidade originada do lead #{{ $lead->id }}"></div>
                    <div><label class="capsula-label">Valor estimado</label><input name="estimated_value" type="number" step="0.01" class="capsula-input"></div>
                    <div><label class="capsula-label">Previsão de fechamento</label><input name="expected_close_date" type="date" class="capsula-input"></div>
                    <div class="md:col-span-2"><label class="capsula-label">Observações</label><textarea name="notes" class="capsula-textarea">{{ $lead->message }}</textarea></div>
                    <div class="md:col-span-2"><button class="capsula-button">Converter lead</button></div>
                </form>
            </div>

            @include('admin.partials.notes', ['noteable' => $lead, 'noteType' => 'lead'])
        </div>

        <div class="capsula-card">
            <h2 class="text-xl font-semibold">Oportunidades vinculadas</h2>
            <div class="mt-5 space-y-4">
                @forelse ($lead->opportunities as $opportunity)
                    <a href="{{ route('admin.opportunities.show', $opportunity) }}" class="block rounded-3xl border border-[var(--capsula-100)] bg-[var(--capsula-50)] px-4 py-4">
                        <p class="font-semibold text-[var(--capsula-900)]">{{ $opportunity->title }}</p>
                        <p class="mt-1 text-sm text-[var(--capsula-500)]">{{ $opportunity->product?->name }} • {{ $opportunity->client?->name ?: 'Sem cliente vinculado' }}</p>
                    </a>
                @empty
                    <p class="text-sm text-[var(--capsula-500)]">Nenhuma oportunidade vinculada ainda.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
