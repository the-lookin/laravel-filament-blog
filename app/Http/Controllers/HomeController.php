<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        $categories = ArticleCategory::where('active', true)->get();
        $articles = Article::get();
        return view('index', compact('categories', 'articles'));
    }

    public function about() {
        return 'about';
    }
}
