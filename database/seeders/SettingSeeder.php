<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Cápsula Corretora',
            'site_tagline' => 'Seguros, consultoria financeira, saúde e mobilidade urbana com atendimento próximo.',
            'company_phone' => '(00) 0000-0000',
            'company_whatsapp' => '(00) 00000-0000',
            'company_email' => 'contato@capsulacorretora.com.br',
            'company_address' => 'Endereço comercial a configurar no painel.',
            'instagram_url' => '',
            'facebook_url' => '',
            'linkedin_url' => '',
            'hero_title' => 'Proteção, consultoria e mobilidade com orientação clara a cada etapa.',
            'hero_subtitle' => 'A Cápsula Corretora integra seguros, consultoria financeira, saúde e mobilidade urbana em uma experiência completa e estratégica. Com atendimento premium e orientação consultiva, ajudamos você a tomar decisões bem fundamentadas para proteger seu patrimônio, sua carreira e o seu futuro em cada etapa da vida.',
            'hero_cta_text' => 'Solicitar proposta',
            'institutional_video_url' => 'https://www.youtube.com/watch?v=M7lc1UVf-VE',
            'seo_home_title' => 'Cápsula Corretora | Soluções consultivas em seguros e locação',
            'seo_home_description' => 'Corretora premium com atendimento consultivo para seguros, consórcios, saúde e locação de longo prazo.',
            'seo_partners_title' => 'Parceiros | Cápsula Corretora',
            'seo_partners_description' => 'Conheça os parceiros comerciais da Cápsula Corretora.',
            'seo_contact_title' => 'Contato | Cápsula Corretora',
            'seo_contact_description' => 'Entre em contato com a Cápsula Corretora e solicite sua proposta.',
        ];

        foreach ($settings as $key => $value) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }
    }
}
