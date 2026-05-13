@extends('layouts.site')

@section('content')
<section class="capsula-container py-14 lg:py-20">
    <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
        <div class="capsula-glass overflow-hidden p-8 lg:p-12">
            <p class="capsula-section-kicker">Atendimento consultivo</p>
            <h1 class="mt-6 font-display text-5xl font-semibold leading-tight md:text-6xl">{{ $siteSettings['hero_title'] }}</h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-[var(--capsula-500)]">{{ $siteSettings['hero_subtitle'] }}</p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="#solicitar-proposta" class="capsula-button">{{ $siteSettings['hero_cta_text'] ?: 'Solicitar proposta' }}</a>
                <a href="#produtos" class="capsula-button-secondary">Conhecer soluções</a>
            </div>
            <div class="mt-10 grid gap-4 md:grid-cols-3">
                <div class="rounded-3xl border border-white/70 bg-white/80 p-5">
                    <p class="text-xs uppercase tracking-[0.3em] text-[var(--capsula-400)]">Proteção</p>
                    <p class="mt-3 text-sm leading-7 text-[var(--capsula-600)]">Seguros e coberturas alinhados ao seu momento e ao seu patrimônio.</p>
                </div>
                <div class="rounded-3xl border border-white/70 bg-white/80 p-5">
                    <p class="text-xs uppercase tracking-[0.3em] text-[var(--capsula-400)]">Mobilidade</p>
                    <p class="mt-3 text-sm leading-7 text-[var(--capsula-600)]">Serviço de carro por assinatura com previsibilidade de custo para pessoa física e empresas.</p>
                </div>
                <div class="rounded-3xl border border-white/70 bg-white/80 p-5">
                    <p class="text-xs uppercase tracking-[0.3em] text-[var(--capsula-400)]">Relação</p>
                    <p class="mt-3 text-sm leading-7 text-[var(--capsula-600)]">Atendimento próximo, claro e com foco em decisão bem orientada.</p>
                </div>
            </div>
        </div>

        @php
        $institutionalVideoUrl = $siteSettings['institutional_video_url'] ?? null;
        $institutionalVideoEmbedUrl = null;

        if ($institutionalVideoUrl) {
        $videoHost = parse_url($institutionalVideoUrl, PHP_URL_HOST);
        $videoPath = trim((string) parse_url($institutionalVideoUrl, PHP_URL_PATH), '/');
        $videoId = null;

        if ($videoHost === 'youtu.be') {
        $videoId = $videoPath;
        }

        if (in_array($videoHost, ['youtube.com', 'www.youtube.com', 'm.youtube.com'], true)) {
        parse_str((string) parse_url($institutionalVideoUrl, PHP_URL_QUERY), $videoQuery);
        $videoId = $videoQuery['v'] ?? null;

        if (str_starts_with($videoPath, 'embed/')) {
        $videoId = str_replace('embed/', '', $videoPath);
        }

        if (str_starts_with($videoPath, 'shorts/')) {
        $videoId = str_replace('shorts/', '', $videoPath);
        }
        }

        if (is_string($videoId) && preg_match('/^[A-Za-z0-9_-]{11}$/', $videoId)) {
        $institutionalVideoEmbedUrl = 'https://www.youtube.com/embed/'.$videoId.'?mute=1&rel=0&modestbranding=1';
        }
        }
        @endphp

        <div class="capsula-card">
            <img src="{{ asset('brand/capsula-corretora.jpg') }}" alt="Identidade visual da Cápsula Corretora" class="w-full rounded-[24px] object-cover shadow-[0_25px_70px_rgba(17,18,21,0.12)]" loading="lazy">
            @if ($institutionalVideoEmbedUrl)
            <div class="mt-6 overflow-hidden rounded-[24px] border border-white/70 bg-[var(--capsula-900)] shadow-[0_25px_70px_rgba(17,18,21,0.12)]">
                <iframe
                    src="{{ $institutionalVideoEmbedUrl }}"
                    title="Vídeo institucional da Cápsula Corretora"
                    class="aspect-video w-full"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
            @endif
        </div>
    </div>
</section>

<section id="sobre" class="capsula-container py-10 lg:py-16">
    <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr]">
        <div>
            <p class="capsula-section-kicker">Sobre a corretora</p>
            <h2 class="mt-4 capsula-section-title">Uma corretora para quem valoriza clareza, segurança e atendimento próximo.</h2>
        </div>
        <div class="capsula-card grid gap-5 text-sm leading-8 text-[var(--capsula-600)]">
            <p>A Cápsula Corretora organiza seguros, consultoria financeira, saúde e mobilidade urbana com uma abordagem consultiva e objetiva. Cada indicação parte do contexto real do cliente, sem promessas exageradas e sem complexidade desnecessária.</p>
            <p>Nosso papel é traduzir opções, estruturar propostas e conduzir o atendimento com o nível de confiança que se espera de uma relação comercial duradoura.</p>
        </div>
    </div>
</section>

<section id="produtos" class="capsula-container py-10 lg:py-16">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
            <p class="capsula-section-kicker">Produtos</p>
            <h2 class="mt-4 capsula-section-title">Soluções para pessoas, famílias e empresas.</h2>
        </div>
        <p class="max-w-xl text-sm leading-7 text-[var(--capsula-500)]">Selecionamos produtos com leitura prática, comparação transparente e encaminhamento comercial organizado.</p>
    </div>

    <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($featuredProducts as $product)
        <article class="capsula-card">
            <h3 class="mt-4 text-2xl font-semibold">{{ $product->name }}</h3>
            <p class="mt-4 text-sm leading-7 text-[var(--capsula-500)]">{{ $product->short_description }}</p>
        </article>
        @endforeach
    </div>
</section>

<section class="capsula-container py-10 lg:py-16">
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="capsula-card lg:row-span-2">
            <p class="capsula-section-kicker">Diferenciais</p>
            <h2 class="mt-4 text-3xl font-semibold">Operação objetiva, sem excesso.</h2>
        </div>
        <div class="capsula-card">
            <h3 class="text-lg font-semibold">Leitura clara de propostas</h3>
            <p class="mt-3 text-sm leading-7 text-[var(--capsula-500)]">Traduzimos as opções, esclarecemos coberturas e custos, e comparamos cenários para que você tome decisões seguras e bem fundamentadas.</p>
        </div>
        <div class="capsula-card">
            <h3 class="text-lg font-semibold">Atendimento centralizado</h3>
            <p class="mt-3 text-sm leading-7 text-[var(--capsula-500)]">Tudo organizado em um único lugar, gestão integrada dos seus seguros e serviços, com histórico completo e acesso simples para acompanhar cada contratação com clareza e controle.</p>
        </div>
        <div class="capsula-card lg:col-start-2">
            <h3 class="text-lg font-semibold">Relacionamento de longo prazo</h3>
            <p class="mt-3 text-sm leading-7 text-[var(--capsula-500)]">Acompanhamento contínuo das suas apólices, com renovações planejadas e gestão proativa para manter sua proteção sempre atualizada.</p>
        </div>
        <div class="capsula-card">
            <h3 class="text-lg font-semibold">Imagem institucional premium</h3>
            <p class="mt-3 text-sm leading-7 text-[var(--capsula-500)]">Presença digital sóbria e confiável, com conteúdo técnico baseado em fontes das seguradoras para informar com clareza e credibilidade.</p>
        </div>
    </div>
</section>

<section class="capsula-container py-10 lg:py-16">
    <div class="capsula-card grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
        <div>
            <p class="capsula-section-kicker">Parceiros comerciais</p>
            <h2 class="mt-4 text-3xl font-semibold">Rede de parceiros reconhecidos pelo mercado.</h2>
            <p class="mt-4 text-sm leading-7 text-[var(--capsula-500)]">Alianças estratégicas que ampliam o portfólio e garantem soluções adequadas ao momento de cada cliente.</p>
        </div>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            @foreach ($partners as $partner)
            <div class="flex min-h-28 items-center justify-center rounded-3xl border border-[var(--capsula-100)] bg-white p-4">
                @if ($partner->logo_path)
                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-14 w-auto object-contain" loading="lazy">
                @else
                <span class="text-sm font-semibold text-[var(--capsula-500)]">{{ $partner->name }}</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="capsula-container py-10 lg:py-16">
    <div class="capsula-card bg-[var(--capsula-900)] text-white">
        <p class="capsula-section-kicker text-white/50">CTA principal</p>
        <div class="mt-4 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="text-3xl font-semibold text-white">Fale com a Cápsula Corretora e receba uma proposta orientada ao seu contexto.</h2>
                <p class="mt-4 max-w-2xl text-sm leading-7 text-white/70">Seguros, consultoria financeira, saúde e mobilidade urbana com linguagem simples e atendimento responsável.</p>
            </div>
            <a href="#solicitar-proposta" class="capsula-button-secondary border-white/20 bg-white/10 text-white hover:bg-white hover:text-[var(--capsula-900)]">Quero iniciar o atendimento</a>
        </div>
    </div>
</section>

<section id="solicitar-proposta" class="capsula-container py-10 lg:py-16">
    <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr]">
        <div>
            <p class="capsula-section-kicker">Solicitar proposta</p>
            <h2 class="mt-4 capsula-section-title">Envie sua necessidade e retornaremos com atendimento humano.</h2>
            <p class="mt-5 text-sm leading-7 text-[var(--capsula-500)]">O formulário abaixo coleta apenas as informações necessárias para contato inicial e qualificação comercial do seu pedido.</p>
        </div>
        <div class="capsula-card">
            @include('site.partials.lead-form')
        </div>
    </div>
</section>

<section class="capsula-container py-10 lg:py-16">
    <div class="grid gap-8 lg:grid-cols-[0.8fr_1.2fr]">
        <div>
            <p class="capsula-section-kicker">FAQ</p>
            <h2 class="mt-4 capsula-section-title">Perguntas frequentes</h2>
        </div>
        <div class="space-y-4">
            <details class="capsula-card">
                <summary class="cursor-pointer text-lg font-semibold">Vocês fazem cotação de quais produtos?</summary>
                <p class="mt-4 text-sm leading-7 text-[var(--capsula-500)]">Atendemos seguros de veículos, vida, residencial, empresarial, viagem, moto, saúde/odonto, consórcios e locação de longo prazo por assinatura.</p>
            </details>
            <details class="capsula-card">
                <summary class="cursor-pointer text-lg font-semibold">A locação é por diária?</summary>
                <p class="mt-4 text-sm leading-7 text-[var(--capsula-500)]">Não. Na V1, tratamos locação como produto comercial de longo prazo, assinatura ou aluguel anual de veículos.</p>
            </details>
            <details class="capsula-card">
                <summary class="cursor-pointer text-lg font-semibold">Recebo a proposta por e-mail ou WhatsApp?</summary>
                <p class="mt-4 text-sm leading-7 text-[var(--capsula-500)]">O retorno pode acontecer por telefone, e-mail ou WhatsApp, conforme o melhor canal para conduzir a conversa comercial.</p>
            </details>
        </div>
    </div>
</section>
@endsection