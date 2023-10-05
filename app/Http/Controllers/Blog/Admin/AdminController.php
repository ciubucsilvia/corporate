<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

abstract class AdminController extends Controller
{
    protected $template;
    protected $vars;
    
    protected $title;
    protected $content;
    protected $folder;

    protected $user;

    public function __construct()
    {
        $this->template = env('THEME') . '.admin.index';  

        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function renderOutput()
    {
        if(!$this->user->hasPermissionTo('View Admin')) {
            abort(403);
        }

        $this->vars = Arr::add($this->vars, 'title', $this->title);
        $this->vars = Arr::add($this->vars, 'content', $this->content);

        $sidebar = view(env('THEME') . '.admin.parts.sidebar')->render();
        $this->vars = Arr::add($this->vars, 'sidebar', $sidebar);

        $navbar = view(env('THEME') . '.admin.parts.navbar')->render();
        $this->vars = Arr::add($this->vars, 'navbar', $navbar);

        $footer = view(env('THEME') . '.admin.parts.footer')->render();
        $this->vars = Arr::add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }
}
