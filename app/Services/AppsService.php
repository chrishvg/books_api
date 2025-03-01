<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class AppsService
{
    public function getAppData(string $appId): ?array
    {
        $path = public_path("source-api/app.json");
        if (!File::exists($path)) {
            return null;
        }

        $apps = json_decode(File::get($path), true);
        return collect($apps)->firstWhere('id', $appId);
    }
}
