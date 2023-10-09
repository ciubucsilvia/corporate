<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Repositories\PortofolioCategoryRepository;
use Illuminate\Http\Request;

class PortfolioCategoryController extends BaseController
{
    protected $portfolio_category_repository;

    public function __construct()
    {
        parent::__construct();
        $this->portfolio_category_repository = app(PortofolioCategoryRepository::class);
    }
   
    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $category = $this->portfolio_category_repository
            ->getBySlug($slug);
        $portfolios = $category->portfolios()->simplePaginate(6);

        $this->content = view(env('THEME') . '.portfolios_content',
            compact('portfolios'));
        
        return $this->renderOutput();
    }
}
