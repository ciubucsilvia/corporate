<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Support\Arr;
use App\Repositories\SliderRepository;

class IndexController extends BaseController
{
    protected $slider_repository;

    public function __construct()
    {
        parent::__construct();

        $this->slider_repository = app(SliderRepository::class);

        $this->template = env('THEME') . '.index';
        $this->title = 'Pink Rio | A strong, powerful and multiporpose Theme';
        $this->bar = 'right';
    }

    public function index()
    {
        $sliderItems = $this->slider_repository
            ->getSliders(config('settings.home_sliders_count'), ['active', 1]);
        $this->slider = view(env('THEME') . '.slider', compact('sliderItems'));

        $items = $this->portfolio_repository
            ->getPortfolios(config('settings.home_portfolio_count'));
        $this->content = view(env('THEME') . '.content_home',
            compact('items'));

        $articles = $this->article_repository
            ->getArticles(config('settings.sidebar_articles_count'), ['is_published', 1]);
        $this->sidebar = view(env('THEME') . '.sidebar', compact('articles'));

        return $this->renderOutput();
    }
}
