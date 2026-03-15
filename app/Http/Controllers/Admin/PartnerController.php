<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerRequest;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(Request $request): View
    {
        $partners = Partner::query()
            ->when($request->filled('q'), fn ($query) => $query->where('name', 'like', '%'.$request->string('q').'%'))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.parceiros.index', [
            'partners' => $partners,
        ]);
    }

    public function create(): View
    {
        return view('admin.parceiros.create', [
            'partner' => new Partner(['is_active' => true]),
        ]);
    }

    public function store(PartnerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['logo'], $data['remove_logo']);
        $data['logo_path'] = $request->file('logo')?->store('partners/uploads', 'public');

        $partner = Partner::query()->create($data);

        return redirect()->route('admin.partners.edit', $partner)->with('status', 'Parceiro cadastrado com sucesso.');
    }

    public function edit(Partner $partner): View
    {
        return view('admin.parceiros.edit', [
            'partner' => $partner,
        ]);
    }

    public function update(PartnerRequest $request, Partner $partner): RedirectResponse
    {
        $data = $request->validated();
        unset($data['logo'], $data['remove_logo']);

        if ($request->boolean('remove_logo') && $partner->logo_path) {
            Storage::disk('public')->delete($partner->logo_path);
            $data['logo_path'] = null;
        }

        if ($request->hasFile('logo')) {
            if ($partner->logo_path) {
                Storage::disk('public')->delete($partner->logo_path);
            }

            $data['logo_path'] = $request->file('logo')->store('partners/uploads', 'public');
        }

        $partner->update($data);

        return redirect()->route('admin.partners.edit', $partner)->with('status', 'Parceiro atualizado com sucesso.');
    }
}
