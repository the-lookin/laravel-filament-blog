<?php

namespace App\Providers;

use App\Models\ArticleCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function($view) {
            $categories = ArticleCategory::where('active', true)->get();
            $view->with('categories', $categories);
        });
    }
}
