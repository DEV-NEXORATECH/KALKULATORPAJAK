<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $articles = Article::where('is_published', true)->latest('published_at')->paginate(9);
        $categories = Article::where('is_published', true)->select('kategori')->distinct()->pluck('kategori');
        return view('education.index', compact('articles', 'categories'));
    }

    public function show(Article $article)
    {
        abort_if(!$article->is_published, 404);
        return view('education.show', compact('article'));
    }
}
