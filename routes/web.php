<?php

use App\Http\Controllers\Blog\Admin\ArticleCategoryController as AdminArticleCategoryController;
use App\Http\Controllers\Blog\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Blog\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Blog\Admin\PermissionController;
use App\Http\Controllers\Blog\Admin\PortfolioCategoryController as AdminPortfolioCategoryController;
use App\Http\Controllers\Blog\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Blog\Admin\RoleController;
use App\Http\Controllers\Blog\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Blog\Admin\UserController;
use App\Http\Controllers\Blog\ArticleCategoryController;
use App\Http\Controllers\Blog\ArticleController;
use App\Http\Controllers\Blog\IndexController;
use App\Http\Controllers\Blog\PortfolioCategoryController;
use App\Http\Controllers\Blog\PortfolioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Website 
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/portfolios', [PortfolioController::class, 'index'])
    ->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])
    ->name('portfolio.show');
Route::get('/portfolio-categories/{slug}', [PortfolioCategoryController::class, 'show'])
    ->name('portfolioCategory.show');

Route::get('/articles', [ArticleController::class, 'index'])
    ->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])
    ->name('articles.show');
Route::get('/article-categories/{slug}', [ArticleCategoryController::class, 'show'])
    ->name('articleCategory.show');


// Admin Panel
Route::prefix('admin')
    // ->middleware(['auth', 'role:admin'])
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function() {
        Route::get('/', [AdminIndexController::class, 'index'])
            ->name('index');
        
        Route::resource('users', UserController::class)
            ->only(['index', 'edit', 'update', 'destroy']);
        Route::resource('permissions', PermissionController::class);
        Route::resource('roles', RoleController::class);

        Route::resource('sliders', AdminSliderController::class);
        
        Route::resource('portfolio', AdminPortfolioController::class);
        Route::resource('portfolio-categories', AdminPortfolioCategoryController::class);

        Route::resource('articles', AdminArticleController::class);
        Route::resource('article-categories', AdminArticleCategoryController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

