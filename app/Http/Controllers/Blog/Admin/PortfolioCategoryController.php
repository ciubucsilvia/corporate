<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\PortfolioCategory;
use App\Http\Requests\StorePortfolioCategoryRequest;
use App\Http\Requests\UpdatePortfolioCategoryRequest;
use App\Repositories\PortofolioCategoryRepository;

class PortfolioCategoryController extends AdminController
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
        if(!$this->user->hasPermissionTo('View PortfolioCategories')) {
            abort(403);
        }

        $this->title = 'Categories (portfolio)';

        $items = $this->portfolio_category_repository
            ->getItems(config('settings.portfolio_categories.categories_per_page'));

        $this->content = view(env('THEME') . '.admin.portfolio_categories.index',
            compact('items'));

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!$this->user->hasPermissionTo('Create PortfolioCategory')) {
            abort(403);
        }

        $this->title = 'Category (portfolio) :: create';

        $this->content = view(env('THEME') . '.admin.portfolio_categories.create');

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePortfolioCategoryRequest $request)
    {
        $result = PortfolioCategory::create($request->all());

        if($result){
            return redirect()
                ->route('admin.portfolio-categories.index')
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
    public function show(PortfolioCategory $portfolioCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PortfolioCategory $portfolioCategory)
    {
        if(!$this->user->hasPermissionTo('Update PortfolioCategory')){
            abort(403);
        }

        $this->title = 'Category (portfolio) ::update';

        $this->content = view(env('THEME') . '.admin.portfolio_categories.edit',
            compact('portfolioCategory'));

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortfolioCategoryRequest $request, PortfolioCategory $portfolioCategory)
    {
        $result = $portfolioCategory->update($request->all());

        if($result){
            return redirect()
                ->route('admin.portfolio-categories.index')
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
    public function destroy(PortfolioCategory $portfolioCategory)
    {
        if(!$this->user->hasPermissionTo('Delete PortfolioCategory')){
            abort(403);
        }
        
        $result = $portfolioCategory->delete();
        
        return redirect()
            ->route('admin.portfolio-categories.index')
            ->with(['success' => 'Successfully deleted!']);
    }
}
