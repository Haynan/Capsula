<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientServiceRequest;
use App\Models\Client;
use App\Models\ClientService;
use Illuminate\Http\RedirectResponse;

class ClientServiceController extends Controller
{
    public function store(ClientServiceRequest $request, Client $client): RedirectResponse
    {
        $client->clientServices()->create($request->validated());

        return redirect()->route('admin.clients.show', $client)->with('status', 'Histórico do cliente adicionado com sucesso.');
    }

    public function update(ClientServiceRequest $request, Client $client, ClientService $clientService): RedirectResponse
    {
        abort_unless($clientService->client_id === $client->id, 404);

        $clientService->update($request->validated());

        return redirect()->route('admin.clients.show', $client)->with('status', 'Histórico do cliente atualizado com sucesso.');
    }
}
