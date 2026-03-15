<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        return view('site.pages.partners', [
            'partners' => Partner::query()
                ->active()
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
            'seoTitle' => view()->shared('siteSettings')['seo_partners_title'] ?? null,
            'seoDescription' => view()->shared('siteSettings')['seo_partners_description'] ?? null,
        ]);
    }
}
