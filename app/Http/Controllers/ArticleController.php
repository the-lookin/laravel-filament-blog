<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::where('active', true)->latest('published_at')->paginate(6);
        return view('article.index', compact('articles'));
    }

    public function category($category) {
        $category = ArticleCategory::where('slug', $category)->firstOrFail();
        $articles = Article::where('active', true)->where('category_id', $category->id)->latest('published_at')->paginate(6);
        return view('article.index', compact('articles', 'category'));
    }

    public function show($category, $article) {
        $article = Article::where('slug', $article)->firstOrFail();
        return view('article.show', compact('article'));
    }

    public function tag($tag) {
        $articles = Article::where('active', true)->whereJsonContains('tags', $tag)->latest('published_at')->paginate(6);
        return view('article.index', compact('articles', 'tag'));
    }
}
