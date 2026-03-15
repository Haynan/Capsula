@php
    $links = [
        ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
        ['route' => 'admin.leads.index', 'label' => 'Leads'],
        ['route' => 'admin.clients.index', 'label' => 'Clientes'],
        ['route' => 'admin.opportunities.index', 'label' => 'Oportunidades'],
        ['route' => 'admin.proposals.index', 'label' => 'Propostas'],
        ['route' => 'admin.renewals.index', 'label' => 'Renovações'],
        ['route' => 'admin.products.index', 'label' => 'Produtos'],
        ['route' => 'admin.partners.index', 'label' => 'Parceiros'],
        ['route' => 'admin.settings.edit', 'label' => 'Configurações'],
        ['route' => 'admin.profile.edit', 'label' => 'Perfil'],
    ];
@endphp

@foreach ($links as $link)
    <a href="{{ route($link['route']) }}" class="capsula-sidebar-link {{ request()->routeIs(str_replace('.index', '.*', $link['route'])) || request()->routeIs($link['route']) ? 'capsula-sidebar-link-active' : '' }}">
        {{ $link['label'] }}
    </a>
@endforeach
