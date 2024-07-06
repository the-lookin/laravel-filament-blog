<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $articles = Article::get();
        return view('index', compact('articles'));
    }

    public function about() {
        return 'about';
    }
}
