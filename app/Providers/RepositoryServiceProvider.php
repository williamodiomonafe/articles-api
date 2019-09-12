<?php

namespace App\Providers;

use App\Repositories\ArticleRepository;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ArticleRepositoryInterface::class,
            ArticleRepository::class
        );
    }
}
