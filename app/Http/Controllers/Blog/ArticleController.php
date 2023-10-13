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
        $this->setSidebar();

        $articles = $this->article_repository->getArticles();
        $this->content = view(env('THEME') . '.articles_content', 
            compact('articles'));
    
        return $this->renderOutput();
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
        // dd($article->comments);
        if(!$article) {
            abort(404);
        }
        
        $this->title = $article->title;

        $this->setSidebar();

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

    private function setSidebar()
    {
        $recentPosts = $this->article_repository
            ->getArticles(config('settings.recent_articles'), ['is_published', 1]);
        
        $comments = $this->comment_repository
            ->getComments(config('settings.recent_comments'));
        if($comments){
            $comments->load('article', 'user');
        }

        $this->sidebar = view(env('THEME') . '.sidebar_article', 
            compact('recentPosts', 'comments'));

    }
}
