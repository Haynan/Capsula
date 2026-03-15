<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PrivacyPolicyController extends Controller
{
    public function __invoke(): View
    {
        return view('site.pages.privacy', [
            'seoTitle' => 'Política de Privacidade | '.config('app.name'),
            'seoDescription' => 'Política de privacidade e tratamento de dados da Cápsula Corretora.',
        ]);
    }
}
