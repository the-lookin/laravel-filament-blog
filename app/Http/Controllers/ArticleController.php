<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $pageTitle = 'Статьи';
        $articles = Article::where('active', true)->latest('published_at')->paginate(6);
        return view('article.index', compact('articles', 'pageTitle'));
    }

    public function category($category) {
        $category = ArticleCategory::where('slug', $category)->firstOrFail();
        $articles = Article::where('active', true)->where('category_id', $category->id)->latest('published_at')->paginate(6);
        $pageTitle = $category->title;
        return view('article.index', compact('articles', 'category', 'pageTitle'));
    }

    public function show($category, $article) {
        $article = Article::where('slug', $article)->firstOrFail();
        $pageTitle = $article->title;
        return view('article.show', compact('article', 'pageTitle'));
    }

    public function tag($tag) {
        $articles = Article::where('active', true)->whereJsonContains('tags', $tag)->latest('published_at')->paginate(6);
        $pageTitle = 'Тег: ' . $tag;
        return view('article.index', compact('articles', 'tag', 'pageTitle'));
    }

    public function search(Request $request) {
        $query = $request->input('query');
        
        // title description

        if(!$query || $query == '') {
            abort(404, 'Запрос не найден');            
        }

        $articles = Article::where('title', 'like', '%' . $query . '%')
            ->orWhere('detail_text', 'like', '%' . $query . '%')
            ->paginate(6);
        
            $pageTitle = 'Поиск: ' . $query;

        return view('article.index', compact('articles', 'query', 'pageTitle'));
    }
}
