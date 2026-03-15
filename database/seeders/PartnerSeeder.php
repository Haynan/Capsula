<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $logosPath = base_path('logos');

        if (! File::isDirectory($logosPath)) {
            return;
        }

        $displayNames = [
            'akad' => 'Akad',
            'allianz' => 'Allianz',
            'amil' => 'Amil',
            'bradesco-seguros' => 'Bradesco Seguros',
            'ezze-seguros' => 'Ezze Seguros',
            'hdi-seguros' => 'HDI Seguros',
            'ituran' => 'Ituran',
            'porto-seguro' => 'Porto Seguro',
            'suhai-seguradora' => 'Suhai Seguradora',
            'sulamerica' => 'SulAmerica',
            'tokio-marine-seguradora' => 'Tokio Marine Seguradora',
            'zurich' => 'Zurich',
        ];

        foreach (File::files($logosPath) as $index => $file) {
            $filename = $file->getFilename();
            $slug = Str::slug(pathinfo($filename, PATHINFO_FILENAME));
            $storagePath = 'partners/imported/'.$filename;

            if (! Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->put($storagePath, File::get($file->getPathname()));
            }

            Partner::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $displayNames[$slug] ?? Str::of(pathinfo($filename, PATHINFO_FILENAME))->replace(['-', '_'], ' ')->title()->value(),
                    'logo_path' => $storagePath,
                    'description' => null,
                    'website_url' => null,
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }
    }
}
