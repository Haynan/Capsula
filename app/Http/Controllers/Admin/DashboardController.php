<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LeadStatus;
use App\Enums\OpportunityStatus;
use App\Enums\ProposalStatus;
use App\Enums\RenewalStatus;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Note;
use App\Models\Opportunity;
use App\Models\Proposal;
use App\Models\Renewal;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard.index', [
            'stats' => [
                'totalLeads' => Lead::query()->count(),
                'newLeads' => Lead::query()->where('status', LeadStatus::New)->count(),
                'openOpportunities' => Opportunity::query()->whereIn('status', [OpportunityStatus::Open, OpportunityStatus::InProgress])->count(),
                'pendingProposals' => Proposal::query()->whereIn('status', [ProposalStatus::Draft, ProposalStatus::Sent])->count(),
                'upcomingRenewals' => Renewal::query()->whereDate('due_date', '>=', now()->toDateString())->whereDate('due_date', '<=', now()->addDays(30)->toDateString())->count(),
                'activeClients' => Client::query()->count(),
            ],
            'latestLeads' => Lead::query()->latest()->take(6)->get(),
            'nextRenewals' => Renewal::query()
                ->with(['client', 'product'])
                ->whereIn('status', [RenewalStatus::Pending, RenewalStatus::Contacting])
                ->whereDate('due_date', '>=', Carbon::today()->toDateString())
                ->orderBy('due_date')
                ->take(6)
                ->get(),
            'recentNotes' => Note::query()->with('user')->latest()->take(8)->get(),
        ]);
    }
}
