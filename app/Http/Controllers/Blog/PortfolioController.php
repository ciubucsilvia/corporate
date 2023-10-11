<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioController extends BaseController
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
        $portfolios = $this->portfolio_repository->getPortfolios();
        $this->content = view(env('THEME') . '.portfolios_content', 
            compact('portfolios'));
    
        return $this->renderOutput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $portfolio = $this->portfolio_repository->getBySlug($slug);
        $otherProjects = $this->portfolio_repository
            ->getPortfolios(config('settings.other_projects'));

        $this->content = view(env('THEME') . '.portfolio_show',
            compact('portfolio', 'otherProjects'));
        
        return $this->renderOutput();
    }

    public function getPortfolio($take = null)
    {
       $select = ['id', 'title', 'slug', 'image', 'category_id', 'content'];
        
       $result = $this->getItems($take, $select);
       
       return $result;
    }
}
