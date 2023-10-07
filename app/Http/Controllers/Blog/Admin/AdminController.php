<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\PortofolioCategoryRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
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

    protected $portfolio_category_repository;
    protected $permission_repository;
    protected $role_repository;

    public function __construct()
    {
        $this->template = env('THEME') . '.admin.index';  

        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            return $next($request);
        });

        $this->portfolio_category_repository = app(PortofolioCategoryRepository::class);        
        $this->permission_repository = app(PermissionRepository::class);
        $this->role_repository = app(RoleRepository::class);
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
