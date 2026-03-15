<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ClientServiceStatus;
use App\Enums\ClientType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\Client;
use App\Models\Partner;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(Request $request): View
    {
        $clients = Client::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = $request->string('q');
                $query->where(function ($inner) use ($term) {
                    $inner->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%")
                        ->orWhere('document', 'like', "%{$term}%");
                });
            })
            ->when($request->filled('type'), fn ($query) => $query->where('type', $request->string('type')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.clientes.index', [
            'clients' => $clients,
            'types' => ClientType::cases(),
        ]);
    }

    public function create(): View
    {
        return view('admin.clientes.create', [
            'client' => new Client(['type' => ClientType::Individual]),
            'types' => ClientType::cases(),
        ]);
    }

    public function store(ClientRequest $request): RedirectResponse
    {
        $client = Client::query()->create($request->validated());

        return redirect()->route('admin.clients.show', $client)->with('status', 'Cliente cadastrado com sucesso.');
    }

    public function show(Client $client): View
    {
        $client->load([
            'clientServices.product',
            'clientServices.partner',
            'renewals.product',
            'renewals.partner',
            'opportunities.product',
            'notes.user',
        ]);

        return view('admin.clientes.show', [
            'client' => $client,
            'products' => Product::query()->active()->orderBy('name')->get(),
            'partners' => Partner::query()->active()->orderBy('name')->get(),
            'serviceStatuses' => ClientServiceStatus::cases(),
        ]);
    }

    public function edit(Client $client): View
    {
        return view('admin.clientes.edit', [
            'client' => $client,
            'types' => ClientType::cases(),
        ]);
    }

    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        return redirect()->route('admin.clients.show', $client)->with('status', 'Cliente atualizado com sucesso.');
    }
}
