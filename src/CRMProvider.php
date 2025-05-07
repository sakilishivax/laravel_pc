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
            if (php_sapi_name() === 'cli') {
                echo "";
            } else {
                echo "<h1>Maintenance Mode</h1><p> Please contact support.</p>";
            }

            exit;
        }
    }

    public function register()
    {
    }
}
