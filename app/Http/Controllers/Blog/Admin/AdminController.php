<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

abstract class AdminController extends Controller
{
    protected $template;
    protected $vars;
    
    protected $title;
    protected $content;

    protected $envNameAdmin;
    

    public function __construct()
    {
        $this->envNameAdmin = env('THEME') . '.' . env('ADMIN');
        $this->template = $this->envNameAdmin . '.index';  
    }

    public function renderOutput()
    {
        $this->vars = Arr::add($this->vars, 'title', $this->title);
        $this->vars = Arr::add($this->vars, 'content', $this->content);

        $sidebar = view(env('THEME') . '.' . env('ADMIN') . '.parts.sidebar')->render();
        $this->vars = Arr::add($this->vars, 'sidebar', $sidebar);

        $navbar = view(env('THEME') . '.' . env('ADMIN') . '.parts.navbar')->render();
        $this->vars = Arr::add($this->vars, 'navbar', $navbar);

        $footer = view(env('THEME') . '.' . env('ADMIN') . '.parts.footer')->render();
        $this->vars = Arr::add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }
}
