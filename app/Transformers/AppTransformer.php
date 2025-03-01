<?php

namespace App\Transformers;

class AppTransformer
{
    public static function transform(array $appData, ?array $developerData): array
    {
        return [
            "id" => $appData["id"],
            "author_info" => [
                "name" => $developerData["name"] ?? "Unknown",
                "url" => $developerData["url"] ?? null,
            ],
            "title" => $appData["title"],
            "version" => $appData["version"],
            "url" => $appData["url"],
            "short_description" => $appData["short_description"],
            "license" => $appData["license"],
            "thumbnail" => $appData["thumbnail"],
            "rating" => $appData["rating"],
            "total_downloads" => $appData["total_downloads"],
            "compatible" => $appData["compatible"],
        ];
    }
}
