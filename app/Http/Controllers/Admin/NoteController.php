<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NoteStoreRequest;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Opportunity;
use App\Models\Proposal;
use App\Models\Renewal;
use Illuminate\Http\RedirectResponse;

class NoteController extends Controller
{
    public function store(NoteStoreRequest $request): RedirectResponse
    {
        $map = [
            'lead' => Lead::class,
            'client' => Client::class,
            'opportunity' => Opportunity::class,
            'proposal' => Proposal::class,
            'renewal' => Renewal::class,
        ];

        $modelClass = $map[$request->validated('noteable_type')];
        $model = $modelClass::query()->findOrFail($request->validated('noteable_id'));

        $model->notes()->create([
            'user_id' => $request->user()->id,
            'content' => $request->validated('content'),
        ]);

        return back()->with('status', 'Nota adicionada com sucesso.');
    }
}
