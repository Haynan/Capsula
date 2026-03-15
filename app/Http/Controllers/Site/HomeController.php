<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('site.pages.home', [
            'featuredProducts' => Product::query()
                ->active()
                ->where('is_featured', true)
                ->orderBy('sort_order')
                ->take(6)
                ->get(),
            'partners' => Partner::query()
                ->active()
                ->orderBy('sort_order')
                ->take(8)
                ->get(),
            'seoTitle' => view()->shared('siteSettings')['seo_home_title'] ?? null,
            'seoDescription' => view()->shared('siteSettings')['seo_home_description'] ?? null,
        ]);
    }
}
