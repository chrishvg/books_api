<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AppsService;
use App\Services\DevelopersService;
use App\Transformers\AppTransformer;

class GetAppInfo extends Command
{
    protected $signature = 'app:info {id}';
    protected $description = 'Fetch and display app information by ID';

    protected AppsService $appsService;
    protected DevelopersService $developersService;

    public function __construct(AppsService $appsService, DevelopersService $developersService)
    {
        parent::__construct();
        $this->appsService = $appsService;
        $this->developersService = $developersService;
    }

    public function handle()
    {
        $appId = $this->argument('id');

        $appData = $this->appsService->getAppData($appId);
        if (!$appData) {
            $this->error("App not found");
            return 1;
        }

        $developerData = $this->developersService->getDeveloperData($appData['developer_id']);
        $response = AppTransformer::transform($appData, $developerData);

        $this->line(json_encode($response, JSON_PRETTY_PRINT));
        return 0;
    }
}