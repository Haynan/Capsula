<?php

namespace App\Http\Controllers\Admin;

use App\Actions\UpsertSiteSettingsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingsUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.configuracoes.edit');
    }

    public function update(SettingsUpdateRequest $request, UpsertSiteSettingsAction $action): RedirectResponse
    {
        $action->execute($request->validated());

        return redirect()->route('admin.settings.edit')->with('status', 'Configurações atualizadas com sucesso.');
    }
}
