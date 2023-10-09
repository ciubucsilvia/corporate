<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Repositories\PortfolioRepository;

abstract class BaseController extends Controller
{
    protected $template;
    protected $vars;

    protected $title;
    protected $content = null;
    protected $bar = 'no';
    protected $slider = null;

    protected $portfolio_repository;

    public function __construct()
    {
        $this->portfolio_repository = app(PortfolioRepository::class);
        $this->template = env('THEME') . '.index';
    }

    public function renderOutput()
    {
        $this->vars = Arr::add($this->vars, 'title', $this->title);
        $this->vars = Arr::add($this->vars, 'bar', $this->bar);
        $this->vars = Arr::add($this->vars, 'slider', $this->slider);
        $this->vars = Arr::add($this->vars, 'content', $this->content);
        
        $navigation = view(env('THEME') . '.navigation');
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);

        $footer = view(env('THEME') . '.footer');
        $this->vars = Arr::add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }
}
