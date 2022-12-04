<?php

namespace App\Providers;

use App\Repositories\Implementations\ActivityRepository;
use App\Repositories\Implementations\ReferencesRepository;
use App\Repositories\Interfaces\ActivityInterface;
use App\Repositories\Interfaces\ReferencesInterfaces;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{

    public $bindings = [
        ReferencesInterfaces::class => ReferencesRepository::class,
        ActivityInterface::class => ActivityRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
