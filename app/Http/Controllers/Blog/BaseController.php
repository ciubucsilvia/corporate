<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

abstract class BaseController extends Controller
{
    protected $template;
    protected $title;
    protected $vars;

    public function __construct()
    {

    }

    public function renderOutput()
    {
        $this->vars = Arr::add($this->vars, 'title', $this->title);

        $navigation = view(env('THEME') . '.navigation');
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);

        $slider = view(env('THEME') . '.slider');
        $this->vars = Arr::add($this->vars, 'slider', $slider);

        $footer = view(env('THEME') . '.footer');
        $this->vars = Arr::add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }
}
