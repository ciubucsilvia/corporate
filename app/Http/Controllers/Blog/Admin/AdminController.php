<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use App\Repositories\PortofolioCategoryRepository;
use App\Repositories\ArticleCategoryRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Menu;

abstract class AdminController extends Controller
{
    protected $template;
    protected $vars;
    
    protected $title;
    protected $content;
    protected $folder;

    protected $user;

    protected $portfolio_category_repository;
    protected $article_category_repository;
    protected $article_repository;

    protected $permission_repository;
    protected $role_repository;

    public function __construct()
    {
        $this->template = env('THEME') . '.admin.index';  

        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            if(!$this->user) {
                abort(404);
            }

            return $next($request);
        });

        $this->portfolio_category_repository = app(PortofolioCategoryRepository::class);
        $this->article_category_repository = app(ArticleCategoryRepository::class);
        $this->article_repository = app(ArticleRepository::class);

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

        $menuInNavbar = $this->getMenuInNavbar();
        $navbar = view(env('THEME') . '.admin.parts.navbar', 
            compact('menuInNavbar'));
        $this->vars = Arr::add($this->vars, 'navbar', $navbar);

        $menuInSidebar = $this->getMenuInSidebar();
        $sidebar = view(env('THEME') . '.admin.parts.sidebar', 
            compact('menuInSidebar'))->render();
        $this->vars = Arr::add($this->vars, 'sidebar', $sidebar);

        

        $footer = view(env('THEME') . '.admin.parts.footer')->render();
        $this->vars = Arr::add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }

    private function getMenuInNavbar()
    {
        return Menu::make('NavbarAdmin', function($menu) {
            if($this->user->hasRole('admin')) {
                $barsButton = $menu->add('<i class="fas fa-bars"></i>', [
                    'class' => 'nav-item'
                ]);
                $barsButton->link->attr([
                    'class' => "nav-link",
                    'data-widget' => "pushmenu",
                    'role' => "button"
                ]);

                $users = $menu->add('Users', [
                    'route' => 'admin.users.index', 
                    'class' => 'nav-item d-none d-sm-inline-block'
                ]);
                $users->link->attr(['class' => 'nav-link']);
                
                $roles = $menu->add('Roles', [
                    'route' => 'admin.roles.index',
                    'class' => 'nav-item d-none d-sm-inline-block'
                ]);    
                $roles->link->attr(['class' => 'nav-link']);

                $permissions = $menu->add('Permissions', [
                    'route' => 'admin.permissions.index',
                    'class' => 'nav-item d-none d-sm-inline-block'
                ]);
                $permissions->link->attr(['class' => 'nav-link']);
            }
    	});
    }

    private function getMenuInSidebar()
    {
        return Menu::make('SidebarAdmin', function($menu) {
            if($this->user->hasPermissionTo('View Sliders')) {
                $item = $menu->add('Sliders', [
                    'route' => 'admin.sliders.index', 
                    'class' => 'nav-item'
                ]);
                $item->link->attr(['class' => 'nav-link']);
            }
            
            if($this->user->hasPermissionTo('View PortfolioCategories')) {
                $item = $menu->add('Categories (portfolio)', [
                    'route' => 'admin.portfolio-categories.index', 
                    'class' => 'nav-item'
                ]);
                $item->link->attr(['class' => 'nav-link']);
            }

            if($this->user->hasPermissionTo('View Portfolios')) {
                $item = $menu->add('Portfolios', [
                    'route' => 'admin.portfolio.index', 
                    'class' => 'nav-item'
                ]);
                $item->link->attr(['class' => 'nav-link']);
            }

            if($this->user->hasPermissionTo('View ArticleCategories')) {
                $item = $menu->add('Categories (article)', [
                    'route' => 'admin.article-categories.index', 
                    'class' => 'nav-item'
                ]);
                $item->link->attr(['class' => 'nav-link']);
            }

            if($this->user->hasPermissionTo('View Articles')) {
                $item = $menu->add('Articles', [
                    'route' => 'admin.articles.index', 
                    'class' => 'nav-item'
                ]);
                $item->link->attr(['class' => 'nav-link']);
            }
    	});
    }
}
