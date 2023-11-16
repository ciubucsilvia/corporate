<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleCategoryRepository;
use Illuminate\Http\Request;

class ArticleCategoryController extends BaseController
{
    protected $article_category_repository;

    public function __construct()
    {
        parent::__construct();

        $this->article_category_repository = app(ArticleCategoryRepository::class);
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

        $category = $this->article_category_repository->getBySlug($slug);
        $articles = $category->articles()->paginate();

        $this->content = view(env('THEME') . '.articles_content', 
            compact('articles'));
    
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
