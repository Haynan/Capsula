@props(['value'])

@php
    $classes = match ((string) $value) {
        'novo', 'aberta', 'pendente', 'rascunho' => 'bg-slate-100 text-slate-700',
        'contatado', 'qualificado', 'em_andamento', 'enviada', 'em_contato', 'pendente_renovacao' => 'bg-amber-100 text-amber-700',
        'convertido', 'ganha', 'aceita', 'renovada', 'ativo' => 'bg-emerald-100 text-emerald-700',
        'perdido', 'perdida', 'recusada', 'expirada', 'inativo' => 'bg-rose-100 text-rose-700',
        default => 'bg-zinc-100 text-zinc-700',
    };
@endphp

<span {{ $attributes->class(['capsula-badge', $classes]) }}>
    {{ str((string) $value)->replace('_', ' ')->headline() }}
</span>
