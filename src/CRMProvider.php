<?php

namespace LaravelCRM;

use Illuminate\Support\ServiceProvider;
use Log;

class CRMProvider extends ServiceProvider
{
    public function boot()
    {
        $key = env('PROJECT_LICENSE_KEY'); 
        $validLicenseKey = 'abc1234';

        if ($key !== $validLicenseKey) {
            \Log::critical('Invalid license key or license missing.');

            if (php_sapi_name() === 'cli') {
                echo "⚠️  Invalid or missing license key. Please contact the developer.\n";
            } else {
                echo "<h1>Maintenance Mode</h1><p>This application is not licensed to run. Please contact support.</p>";
            }

            exit;
        }
    }

    public function register()
    {
    }
}
