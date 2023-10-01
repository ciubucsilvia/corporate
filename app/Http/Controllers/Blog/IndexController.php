<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Support\Arr;
use App\Repositories\SliderRepository;

class IndexController extends BaseController
{
    protected $slider_repository;

    public function __construct()
    {
        $this->slider_repository = app(SliderRepository::class);
        $this->template = env('THEME') . '.index';
        $this->title = 'Pink Rio | A strong, powerful and multiporpose Theme';
    }

    public function index()
    {
        $items = $this->getItemsSlider();
        
        $slider = view(env('THEME') . '.slider', compact('items'));
        $this->vars = Arr::add($this->vars, 'slider', $slider);

        return $this->renderOutput();
    }

    protected function getItemsSlider()
    {
        $items = $this->slider_repository->getItems();
        
        return $items->where('active', 1);
    }
}
