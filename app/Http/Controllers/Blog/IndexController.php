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
            ->getSliders(config('settings.home_sliders_count'));
        $this->slider = view(env('THEME') . '.slider', compact('sliderItems'));

        $items = $this->portfolio_repository
            ->getPortfolio(config('settings.home_portfolio_count'));
        $this->content = view(env('THEME') . '.content_home',
            compact('items'));

        return $this->renderOutput();
    }

    // protected function getItemsSlider()
    // {
    //     $select = ['id', 'title', 'active', 'image'];

    //     $items = $this->slider_repository->getItems();
        
    //     return $items->where('active', 1);
    // }
}
