<?php

namespace LaravelCRM;

use Illuminate\Support\ServiceProvider;
use Log;


class CRMProvider extends ServiceProvider
{
    public function boot()
    {
        $key = env('PROJECT_LICENSE_KEY');
        $project = env('PROJECT_NAME', 'default-project');

        $verifyUrl = "https://your-licensing-server.com/api/verify?key={$key}&project={$project}";

        $response = @file_get_contents($verifyUrl);

        $status = json_decode($response, true)['status'] ?? null;

        if ($status !== 'valid') {
            Log::critical('License invalid or verification server unreachable.');

            if (php_sapi_name() === 'cli') {
                echo "⚠️  This application is not activated. Please contact the developer.\\n";
            } else {
                echo "<h1>Maintenance Mode</h1><p>This application is not licensed to run. Contact support.</p>";
            }

            exit;
        }
    }

    public function register()
    {
        //
    }
}