<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DetectDuplicates extends Command
{

    protected $signature = 'detect:duplicates';
    protected $description = 'Detect programs whose 85% similarity';

    public function handle()
    {
        $sourceFile = public_path('source-duplicates/source_publisher-url.csv');
        $catalogFile = public_path('source-duplicates/catalog_publisher-url.csv');
        $outputFile = public_path('output_duplicates/output_not_in_catalog.txt');

        $scriptPath = base_path('scripts/compare_urls.sh');

        if (file_exists($outputFile)) {
            unlink($outputFile);
        }

        $process = new Process(['bash', $scriptPath, $sourceFile, $catalogFile, $outputFile]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->info("Duplicate detection completed. Results saved to: $outputFile");
    }
}