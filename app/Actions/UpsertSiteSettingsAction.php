<?php

namespace App\Actions;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class UpsertSiteSettingsAction
{
    public function execute(array $settings): void
    {
        DB::transaction(function () use ($settings) {
            foreach ($settings as $key => $value) {
                Setting::query()->updateOrCreate(
                    ['key' => $key],
                    ['value' => blank($value) ? null : $value]
                );
            }
        });
    }
}
