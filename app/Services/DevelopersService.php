<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class DevelopersService
{
    public function getDeveloperData(int $developerId): ?array
    {
        $path = public_path("source-api/developer.json");
        if (!File::exists($path)) {
            return null;
        }

        $developers = json_decode(File::get($path), true);
        return collect($developers)->firstWhere('id', $developerId);
    }
}