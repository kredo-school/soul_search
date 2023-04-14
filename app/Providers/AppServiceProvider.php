<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\paginator;
use Illuminate\Auth\Access\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
