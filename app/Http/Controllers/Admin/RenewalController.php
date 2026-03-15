<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RenewalStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RenewalRequest;
use App\Models\Client;
use App\Models\ClientService;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Renewal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RenewalController extends Controller
{
    public function index(Request $request): View
    {
        $renewals = Renewal::query()
            ->with(['client', 'product', 'partner'])
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('due_until'), fn ($query) => $query->whereDate('due_date', '<=', $request->date('due_until')))
            ->orderBy('due_date')
            ->paginate(15)
            ->withQueryString();

        return view('admin.renovacoes.index', [
            'renewals' => $renewals,
            'statuses' => RenewalStatus::cases(),
        ]);
    }

    public function create(): View
    {
        return view('admin.renovacoes.create', $this->formData(new Renewal([
            'status' => RenewalStatus::Pending,
        ])));
    }

    public function store(RenewalRequest $request): RedirectResponse
    {
        $renewal = Renewal::query()->create($request->validated());

        return redirect()->route('admin.renewals.show', $renewal)->with('status', 'Renovação cadastrada com sucesso.');
    }

    public function show(Renewal $renewal): View
    {
        $renewal->load(['client', 'clientService', 'product', 'partner', 'notes.user']);

        return view('admin.renovacoes.show', [
            'renewal' => $renewal,
        ]);
    }

    public function edit(Renewal $renewal): View
    {
        return view('admin.renovacoes.edit', $this->formData($renewal));
    }

    public function update(RenewalRequest $request, Renewal $renewal): RedirectResponse
    {
        $renewal->update($request->validated());

        return redirect()->route('admin.renewals.show', $renewal)->with('status', 'Renovação atualizada com sucesso.');
    }

    private function formData(Renewal $renewal): array
    {
        return [
            'renewal' => $renewal,
            'clients' => Client::query()->orderBy('name')->get(),
            'clientServices' => ClientService::query()->orderBy('title')->get(),
            'products' => Product::query()->active()->orderBy('name')->get(),
            'partners' => Partner::query()->active()->orderBy('name')->get(),
            'statuses' => RenewalStatus::cases(),
        ];
    }
}
