@extends('layouts.site')

@section('content')
    <section class="capsula-container py-16">
        <div class="max-w-3xl">
            <p class="capsula-section-kicker">Parceiros</p>
            <h1 class="mt-4 capsula-section-title">Marcas presentes no ecossistema comercial da corretora.</h1>
            <p class="mt-5 text-sm leading-7 text-[var(--capsula-500)]">Abaixo, os parceiros identificados pelos logos disponíveis no projeto e utilizados na composição institucional da Cápsula Corretora.</p>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($partners as $partner)
                <article class="capsula-card flex flex-col gap-4">
                    <div class="flex min-h-28 items-center justify-center rounded-3xl border border-[var(--capsula-100)] bg-[var(--capsula-50)] p-5">
                        @if ($partner->logo_path)
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-16 w-auto object-contain" loading="lazy">
                        @else
                            <span class="text-sm font-semibold text-[var(--capsula-500)]">{{ $partner->name }}</span>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold">{{ $partner->name }}</h2>
                        @if ($partner->description)
                            <p class="mt-3 text-sm leading-7 text-[var(--capsula-500)]">{{ $partner->description }}</p>
                        @endif
                    </div>
                    @if ($partner->website_url)
                        <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-[var(--capsula-800)]">Visitar site</a>
                    @endif
                </article>
            @empty
                <div class="capsula-card md:col-span-2 xl:col-span-3">
                    <p class="text-sm text-[var(--capsula-500)]">Nenhum parceiro ativo encontrado no momento.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
