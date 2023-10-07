<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\Portfolio;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Repositories\PortfolioRepository;

class PortfolioController extends AdminController
{
    protected $portfolio_repository;

    public function __construct()
    {
        parent::__construct();

        $this->title = 'Portfolio';
        $this->folder = 'portfolios';

        $this->portfolio_repository = app(PortfolioRepository::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!$this->user->hasPermissionTo('View Portfolio')) {
            abort('403');
        }

        $items = $this->portfolio_repository->getItems();
        
        $this->content = view(env('THEME') . '.admin.portfolio.index',
            compact('items'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!$this->user->hasPermissionTo('Create Portfolio')){
            abort(403);
        }

        $this->title .= '::create';
        $categories = $this->portfolio_category_repository->getForComboBox();

        $this->content = view(env('THEME') . '.admin.portfolio.create', 
            compact('categories'));
            
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePortfolioRequest $request)
    {
        $data = $request->all();
        $portfolio = Portfolio::create($data);
        
        // Save image in folder 'public' and in DB
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $portfolio = $this->portfolio_repository->saveImage($portfolio, $file);
        }
        
        // set property 'is_published' 
        $this->portfolio_repository->setIsPublished($portfolio, $data);

        // setUser
        $this->portfolio_repository->setUser($portfolio);
        
        return redirect()
            ->route('admin.portfolio.index')
            ->with(['success' => 'Successfully saved!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio)
    {
        if(!$this->user->hasPermissionTo('Update Portfolio')){
            abort(403);
        }

        $this->title .= '::edit';
        $categories = $this->portfolio_category_repository->getForComboBox();

        $this->content = view(env('THEME') . '.admin.portfolio.edit', 
            compact('categories', 'portfolio'));
            
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio)
    {
        $data = $request->all();
        $portfolio->update($data);
        
        // Save image in folder 'public' and in DB
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $this->portfolio_repository->removeImage($portfolio, $this->folder);
            $portfolio = $this->portfolio_repository->saveImage($portfolio, $file);
        }
        
        // set property 'is_published' 
        $this->portfolio_repository->setIsPublished($portfolio, $data);

        // setUser
        $this->portfolio_repository->setUser($portfolio);
        
        return redirect()
            ->route('admin.portfolio.index')
            ->with(['success' => 'Successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        if(!$this->user->hasPermissionTo('Delete Portfolio')) {
            abort('403');
        }

        $portfolio->delete();
        $this->portfolio_repository->removeImage($portfolio, $this->folder);

        return redirect()
            ->route('admin.portfolio.index')
            ->with(['success' => 'Successfully deleted!']);
    }
}
