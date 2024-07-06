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
        return 'category article ' . $category;
    }

    public function show($category, $article) {
        return 'show article ' . $category . ' ' . $article;
    }

    public function tag($tag) {
        return 'tag article ' . $tag;
    }
}
