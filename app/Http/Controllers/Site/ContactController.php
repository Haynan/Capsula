<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('site.pages.contact', [
            'seoTitle' => view()->shared('siteSettings')['seo_contact_title'] ?? null,
            'seoDescription' => view()->shared('siteSettings')['seo_contact_description'] ?? null,
        ]);
    }
}
