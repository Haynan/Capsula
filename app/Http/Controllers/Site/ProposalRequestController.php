<?php

namespace App\Http\Controllers\Site;

use App\Actions\CreateLeadFromPublicFormAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\PublicLeadRequest;
use Illuminate\Http\RedirectResponse;

class ProposalRequestController extends Controller
{
    public function store(PublicLeadRequest $request, CreateLeadFromPublicFormAction $action): RedirectResponse
    {
        $action->execute($request->validated());

        return back()->with('status', 'Recebemos sua solicitação. Em breve entraremos em contato.');
    }
}
