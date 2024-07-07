<?php

namespace App\Providers;

use App\Models\Article;
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
            $latestArticles = Article::latest('published_at')->take(3)->get();
            
            $articleTags = ['tag1', 'tag2', 'tag3'];
            $articleTags = Article::whereNotNull('tags')->pluck('tags')->flatten()->unique();

            $view->with('categories', $categories);
            $view->with('latestArticles', $latestArticles);
            $view->with('articleTags', $articleTags);
        });
    }
}
