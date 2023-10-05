<?php

use App\Http\Controllers\Blog\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Blog\Admin\PermissionController;
use App\Http\Controllers\Blog\Admin\RoleController;
use App\Http\Controllers\Blog\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Blog\Admin\UserController;
use App\Http\Controllers\Blog\IndexController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');

// Admin
// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
//     Route::get('/', [AdminIndexController::class, 'index'])
//         ->name('adminIndex');
//     Route::resource('sliders', AdminSliderController::class)
//         ->names('admin.sliders');
// });

Route::prefix('admin')
    // ->middleware(['auth', 'role:admin'])
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function() {
        Route::get('/', [AdminIndexController::class, 'index'])
            ->name('index');
        Route::resource('sliders', AdminSliderController::class);

        Route::resource('users', UserController::class)
            ->only(['index', 'edit', 'update', 'destroy']);
        Route::resource('permissions', PermissionController::class);
        Route::resource('roles', RoleController::class);
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

