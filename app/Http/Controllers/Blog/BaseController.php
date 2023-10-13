<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Repositories\PortfolioRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\CommentRepository;
use Menu;

abstract class BaseController extends Controller
{
    protected $template;
    protected $vars;

    protected $title;
    protected $content = null;
    protected $bar = 'no';
    protected $slider = null;
    protected $sidebar = null;

    protected $portfolio_repository;
    protected $article_repository;
    protected $comment_repository;

    public function __construct()
    {
        $this->portfolio_repository = app(PortfolioRepository::class);
        $this->article_repository = app(ArticleRepository::class);
        $this->comment_repository = app(CommentRepository::class);

        $this->template = env('THEME') . '.index';
    }

    public function renderOutput()
    {
        $this->vars = Arr::add($this->vars, 'title', $this->title);
        $this->vars = Arr::add($this->vars, 'bar', $this->bar);
        $this->vars = Arr::add($this->vars, 'sidebar', $this->sidebar);
        $this->vars = Arr::add($this->vars, 'slider', $this->slider);
        $this->vars = Arr::add($this->vars, 'content', $this->content);
        
        $menu = $this->getMenu();
        $navigation = view(env('THEME') . '.navigation', compact('menu'));
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);

        $footer = view(env('THEME') . '.footer');
        $this->vars = Arr::add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }

    private function getMenu()
    {
        return Menu::make('menu', function($menu) {
            $menu->add('HOME', ['route' => 'index']);
            $menu->add('BLOG', ['route' => 'articles.index']);
            $menu->add('PORTFOLIO', ['route' => 'portfolio.index']);
            $menu->add('CONTACT', ['route' => 'contact']);
    	});
    }
}
