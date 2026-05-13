<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('pt_BR');
        setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'Portuguese_Brazil.1252');

        RateLimiter::for('public-lead-form', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip() . '|' . $request->input('email'));
        });

        View::composer(['site.*', 'layouts.site', 'layouts.guest', 'auth.*', 'admin.configuracoes.*'], function ($view) {
            $defaults = collect([
                'site_name' => config('app.name'),
                'site_tagline' => 'Seguros, consórcios e locação de longo prazo com atendimento consultivo.',
                'company_phone' => '',
                'company_whatsapp' => '',
                'company_email' => '',
                'company_address' => '',
                'instagram_url' => '',
                'facebook_url' => '',
                'linkedin_url' => '',
                'hero_title' => 'Soluções sob medida para proteger seu patrimônio e sua tranquilidade.',
                'hero_subtitle' => 'A Cápsula Corretora integra seguros, consultoria financeira, saúde e mobilidade urbana em uma experiência completa e estratégica. Com atendimento premium e orientação consultiva, ajudamos você a tomar decisões bem fundamentadas para proteger seu patrimônio, sua carreira e o seu futuro em cada etapa da vida.',
                'hero_cta_text' => 'Solicitar proposta',
                'institutional_video_url' => 'https://www.youtube.com/watch?v=M7lc1UVf-VE',
                'seo_home_title' => 'Cápsula Corretora | Seguros, consórcios e locação por assinatura',
                'seo_home_description' => 'Corretora premium com atendimento consultivo para seguros, consórcios, saúde e locação de longo prazo.',
                'seo_partners_title' => 'Parceiros | Cápsula Corretora',
                'seo_partners_description' => 'Conheça os parceiros comerciais da Cápsula Corretora.',
                'seo_contact_title' => 'Contato | Cápsula Corretora',
                'seo_contact_description' => 'Fale com a Cápsula Corretora e solicite sua proposta.',
            ]);

            $settings = $defaults;
            $products = collect();

            if (Schema::hasTable('settings')) {
                $settings = $defaults->merge(Setting::query()->pluck('value', 'key'));
            }

            if (Schema::hasTable('products')) {
                $products = Product::query()
                    ->active()
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->get();
            }

            $view->with('siteSettings', $settings);
            $view->with('siteProducts', $products);
        });
    }
}
