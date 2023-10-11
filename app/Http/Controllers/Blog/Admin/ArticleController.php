<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Repositories\ArticleRepository;

class ArticleController extends AdminController
{
    protected $article_repository;

    public function __construct()
    {
        parent::__construct();
        $this->article_repository = app(ArticleRepository::class);
        $this->title = 'Article';
        $this->folder = 'articles';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!$this->user->hasPermissionTo('View Articles')) {
            abort('403');
        }
        $this->title .= 's';

        $items = $this->article_repository->getArticles();
        
        $this->content = view(env('THEME') . '.admin.articles.index',
            compact('items'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!$this->user->hasPermissionTo('Create Article')){
            abort(403);
        }

        $this->title .= '::create';
        $categories = $this->article_category_repository->getForComboBox();

        $this->content = view(env('THEME') . '.admin.articles.create', 
            compact('categories'));
            
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $data = $request->all();
        
        $data['user_id'] = $this->user->id;
        
        $article = Article::create($data);
        
        // Save image in folder 'public' and in DB
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $article = $this->article_repository->saveImage($article, $file, $this->folder);
        }
        
        // set property 'is_published' 
        $this->article_repository->setIsPublished($article, $data);
        
        return redirect()
            ->route('admin.articles.index')
            ->with(['success' => 'Successfully saved!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        if(!$this->user->hasPermissionTo('Update Article')){
            abort(403);
        }

        $this->title .= '::edit';
        $categories = $this->article_category_repository->getForComboBox();
        
        $this->content = view(env('THEME') . '.admin.articles.edit', 
            compact('categories', 'article'));
            
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->all();
        $article->update($data);
        
        // Save image in folder 'public' and in DB
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $this->article_repository->removeImage($article, $this->folder);
            $article = $this->article_repository->saveImage($article, $file, $this->folder);
        }
        
        // set property 'is_published' 
        $this->article_repository->setIsPublished($article, $data);

        return redirect()
            ->route('admin.articles.index')
            ->with(['success' => 'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if(!$this->user->hasPermissionTo('Delete Article')) {
            abort('403');
        }

        $article->delete();
        $this->article_repository->removeImage($article, $this->folder);

        return redirect()
            ->route('admin.articles.index')
            ->with(['success' => 'Successfully deleted!']);
    }
}
