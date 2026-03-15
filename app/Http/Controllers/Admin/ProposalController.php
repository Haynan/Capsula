<?php

namespace App\Http\Controllers\Admin;

use App\Actions\AcceptProposalAction;
use App\Enums\ProposalStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProposalAcceptRequest;
use App\Http\Requests\Admin\ProposalRequest;
use App\Models\Opportunity;
use App\Models\Partner;
use App\Models\Proposal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProposalController extends Controller
{
    public function index(Request $request): View
    {
        $proposals = Proposal::query()
            ->with(['opportunity.client', 'partner'])
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%'.$request->string('q').'%'))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('partner_id'), fn ($query) => $query->where('partner_id', $request->integer('partner_id')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.propostas.index', [
            'proposals' => $proposals,
            'statuses' => ProposalStatus::cases(),
            'partners' => Partner::query()->active()->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.propostas.create', $this->formData(new Proposal([
            'status' => ProposalStatus::Draft,
        ])));
    }

    public function store(ProposalRequest $request): RedirectResponse
    {
        $proposal = Proposal::query()->create($request->validated());

        return redirect()->route('admin.proposals.show', $proposal)->with('status', 'Proposta cadastrada com sucesso.');
    }

    public function show(Proposal $proposal): View
    {
        $proposal->load(['opportunity.client', 'opportunity.lead', 'opportunity.product', 'partner', 'notes.user']);

        return view('admin.propostas.show', [
            'proposal' => $proposal,
            'partners' => Partner::query()->active()->orderBy('name')->get(),
            'clientServices' => $proposal->opportunity->client?->clientServices()->orderBy('title')->get() ?? collect(),
        ]);
    }

    public function edit(Proposal $proposal): View
    {
        return view('admin.propostas.edit', $this->formData($proposal));
    }

    public function update(ProposalRequest $request, Proposal $proposal): RedirectResponse
    {
        $proposal->update($request->validated());

        return redirect()->route('admin.proposals.show', $proposal)->with('status', 'Proposta atualizada com sucesso.');
    }

    public function accept(ProposalAcceptRequest $request, Proposal $proposal, AcceptProposalAction $action): RedirectResponse
    {
        $action->execute($proposal, $request->validated());

        return redirect()->route('admin.proposals.show', $proposal)->with('status', 'Proposta marcada como aceita com sucesso.');
    }

    private function formData(Proposal $proposal): array
    {
        return [
            'proposal' => $proposal,
            'opportunities' => Opportunity::query()->with('client')->latest()->get(),
            'partners' => Partner::query()->active()->orderBy('name')->get(),
            'statuses' => ProposalStatus::cases(),
        ];
    }
}
