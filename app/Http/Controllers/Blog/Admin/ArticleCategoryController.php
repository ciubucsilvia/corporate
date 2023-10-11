<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\StoreArticleCategoryRequest;
use App\Http\Requests\UpdateArticleCategoryRequest;
use App\Models\ArticleCategory;

class ArticleCategoryController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!$this->user->hasPermissionTo('View ArticleCategories')) {
            abort(403);
        }

        $this->title = 'Categories (article)';

        $items = $this->article_category_repository->getCategories();

        $this->content = view(env('THEME') . '.admin.article_categories.index',
            compact('items'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!$this->user->hasPermissionTo('Create ArticleCategory')) {
            abort(403);
        }

        $this->title = 'Category (article) ::create';

        $this->content = view(env('THEME') . '.admin.article_categories.create');

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleCategoryRequest $request)
    {
        $result = ArticleCategory::create($request->all());

        if($result){
            return redirect()
                ->route('admin.article-categories.index')
                ->with(['success' => 'Successfully saved!']);
        } else {
            return back()
                ->withErrors(['msg' => 'Save error!'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleCategory $articleCategory)
    {
        if(!$this->user->hasPermissionTo('Update ArticleCategory')){
            abort(403);
        }

        $this->title = 'Category (article) ::update';

        $this->content = view(env('THEME') . '.admin.article_categories.edit',
            compact('articleCategory'));

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleCategoryRequest $request, ArticleCategory $articleCategory)
    {
        $result = $articleCategory->update($request->all());

        if($result){
            return redirect()
                ->route('admin.article-categories.index')
                ->with(['success' => 'Successfully updated!']);
        } else {
            return back()
                ->withErrors(['msg' => 'Save error!'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        if(!$this->user->hasPermissionTo('Delete ArticleCategory')){
            abort(403);
        }
        
        $result = $articleCategory->delete();
        
        return redirect()
            ->route('admin.article-categories.index')
            ->with(['success' => 'Successfully deleted!']);
    }
}
