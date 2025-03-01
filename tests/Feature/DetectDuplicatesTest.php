<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class DetectDuplicatesTest extends TestCase
{
    public function test_duplicate_detection_runs_successfully()
    {
        file_put_contents(storage_path('test_files/source_publisher-url.csv'), "398,http://kodi.tv/\n13984");
        file_put_contents(storage_path('test_files/catalog_publisher-url.csv'), "http://kodi.tv");

        $process = new Process(['bash', 
            base_path('scripts/compare_urls.sh'),
            storage_path('test_files/source_publisher-url.csv'), 
            storage_path('test_files/catalog_publisher-url.csv'),
            storage_path('test_files/output_not_in_catalog.txt')
        ]);
        $process->run();

        $this->assertFileExists(storage_path('test_files/output_not_in_catalog.txt'));

        $outputContent = file_get_contents(storage_path('test_files/output_not_in_catalog.txt'));

        $this->assertStringContainsString('13984', $outputContent);

        File::delete([
            storage_path('source_publisher-url.csv'),
            storage_path('catalog_publisher-url.csv'),
            storage_path('output_not_in_catalog.txt'),
        ]);
    }
}