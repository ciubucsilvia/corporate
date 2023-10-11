<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->bar = 'right';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $article = $this->article_repository->getBySlug($slug);
        
        if(!$article) {
            abort(404);
        }
        
        $this->title = $article->title;

        $recentPosts = $this->article_repository
            ->getArticles(config('settings.sidebar_articles_count'), ['is_published', 1]);
        $this->sidebar = view(env('THEME') . '.sidebar_article', compact('recentPosts'));

        $this->content = view(env('THEME') . '.article_show', compact('article'));
        return $this->renderOutput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
