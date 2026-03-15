<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OpportunityStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OpportunityRequest;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Opportunity;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OpportunityController extends Controller
{
    public function index(Request $request): View
    {
        $opportunities = Opportunity::query()
            ->with(['lead', 'client', 'product'])
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%'.$request->string('q').'%'))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('product_id'), fn ($query) => $query->where('product_id', $request->integer('product_id')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.oportunidades.index', [
            'opportunities' => $opportunities,
            'products' => Product::query()->active()->orderBy('name')->get(),
            'statuses' => OpportunityStatus::cases(),
        ]);
    }

    public function create(): View
    {
        return view('admin.oportunidades.create', $this->formData(new Opportunity([
            'status' => OpportunityStatus::Open,
        ])));
    }

    public function store(OpportunityRequest $request): RedirectResponse
    {
        $opportunity = Opportunity::query()->create($request->validated());

        return redirect()->route('admin.opportunities.show', $opportunity)->with('status', 'Oportunidade cadastrada com sucesso.');
    }

    public function show(Opportunity $opportunity): View
    {
        $opportunity->load(['lead', 'client', 'product', 'proposals.partner', 'notes.user']);

        return view('admin.oportunidades.show', [
            'opportunity' => $opportunity,
        ]);
    }

    public function edit(Opportunity $opportunity): View
    {
        return view('admin.oportunidades.edit', $this->formData($opportunity));
    }

    public function update(OpportunityRequest $request, Opportunity $opportunity): RedirectResponse
    {
        $opportunity->update($request->validated());

        return redirect()->route('admin.opportunities.show', $opportunity)->with('status', 'Oportunidade atualizada com sucesso.');
    }

    private function formData(Opportunity $opportunity): array
    {
        return [
            'opportunity' => $opportunity,
            'leads' => Lead::query()->latest()->take(50)->get(),
            'clients' => Client::query()->orderBy('name')->get(),
            'products' => Product::query()->active()->orderBy('name')->get(),
            'statuses' => OpportunityStatus::cases(),
        ];
    }
}
