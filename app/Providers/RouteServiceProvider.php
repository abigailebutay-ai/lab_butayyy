<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/tweets'; // <--- CHANGE THIS

    public function boot(): void
    {
        //
    }
}
