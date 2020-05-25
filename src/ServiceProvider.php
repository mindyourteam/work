<?php

namespace Mindyourteam\Work;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;

class ServiceProvider extends IlluminateServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadViewsFrom(__DIR__ . '/../views', 'work');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../topic.php', 'crud.topic'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/../user.php', 'crud.user'
        );

        Route::middleware('web')
            ->namespace('Mindyourteam\\Work\Controllers')
            ->group(__DIR__ . '/../routes.php');
    }
}
