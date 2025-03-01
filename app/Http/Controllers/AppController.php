<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\AppsService;
use App\Services\DevelopersService;
use App\Transformers\AppTransformer;

class AppController extends Controller
{
    protected AppsService $appsService;
    protected DevelopersService $developersService;

    public function __construct(AppsService $appsService, DevelopersService $developersService)
    {
        $this->appsService = $appsService;
        $this->developersService = $developersService;
    }

    public function show(string $appId): JsonResponse
    {
        $appData = $this->appsService->getAppData($appId);
        if (!$appData) {
            return response()->json(["error" => "App not found"], 404);
        }

        $developerData = $this->developersService->getDeveloperData($appData['developer_id']);
        $response = AppTransformer::transform($appData, $developerData);

        return response()->json($response);
    }
}