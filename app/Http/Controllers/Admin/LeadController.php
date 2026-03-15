<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ConvertLeadAction;
use App\Enums\LeadPriority;
use App\Enums\LeadStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LeadConvertRequest;
use App\Http\Requests\Admin\LeadRequest;
use App\Models\Lead;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeadController extends Controller
{
    public function index(Request $request): View
    {
        $leads = Lead::query()
            ->with('product')
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = $request->string('q');
                $query->where(function ($inner) use ($term) {
                    $inner->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%")
                        ->orWhere('phone', 'like', "%{$term}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('priority'), fn ($query) => $query->where('priority', $request->string('priority')))
            ->when($request->filled('product_id'), fn ($query) => $query->where('product_id', $request->integer('product_id')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.leads.index', [
            'leads' => $leads,
            'products' => Product::query()->active()->orderBy('name')->get(),
            'statuses' => LeadStatus::cases(),
            'priorities' => LeadPriority::cases(),
        ]);
    }

    public function create(): View
    {
        return view('admin.leads.create', [
            'lead' => new Lead([
                'status' => LeadStatus::New,
                'priority' => LeadPriority::Normal,
            ]),
            'products' => Product::query()->active()->orderBy('name')->get(),
            'statuses' => LeadStatus::cases(),
            'priorities' => LeadPriority::cases(),
        ]);
    }

    public function store(LeadRequest $request): RedirectResponse
    {
        $lead = Lead::query()->create($request->validated());

        return redirect()->route('admin.leads.show', $lead)->with('status', 'Lead cadastrado com sucesso.');
    }

    public function show(Lead $lead): View
    {
        $lead->load(['product', 'notes.user', 'opportunities.product', 'opportunities.client']);

        return view('admin.leads.show', [
            'lead' => $lead,
            'products' => Product::query()->active()->orderBy('name')->get(),
        ]);
    }

    public function edit(Lead $lead): View
    {
        return view('admin.leads.edit', [
            'lead' => $lead,
            'products' => Product::query()->active()->orderBy('name')->get(),
            'statuses' => LeadStatus::cases(),
            'priorities' => LeadPriority::cases(),
        ]);
    }

    public function update(LeadRequest $request, Lead $lead): RedirectResponse
    {
        $lead->update($request->validated());

        return redirect()->route('admin.leads.show', $lead)->with('status', 'Lead atualizado com sucesso.');
    }

    public function convert(LeadConvertRequest $request, Lead $lead, ConvertLeadAction $action): RedirectResponse
    {
        $result = $action->execute($lead, $request->validated());

        if ($result['opportunity']) {
            return redirect()->route('admin.opportunities.show', $result['opportunity'])->with('status', 'Lead convertido e oportunidade criada com sucesso.');
        }

        return redirect()->route('admin.clients.show', $result['client'])->with('status', 'Lead convertido em cliente com sucesso.');
    }
}
