<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UkmController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AdminTagController;
use App\Http\Controllers\AdminUkmController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/katalog/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

Route::get('/ukm/{slug}', [UkmController::class, 'show'])->name('ukm.show');

Route::get('/berita', [ArticleController::class, 'index'])->name('article.index');
Route::get('/berita/{slug}', [ArticleController::class, 'show'])->name('article.show');

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function (){
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/articles', [AdminArticleController::class, 'index'])->name('admin.articles');
    Route::post('/admin/articles/store', [AdminArticleController::class, 'store'])->name('admin.articles.store');
    Route::get('/admin/articles/edit/{id}', [AdminArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::post('/admin/articles/update', [AdminArticleController::class, 'update'])->name('admin.articles.update');
    Route::get('/admin/articles/delete/{id}', [AdminArticleController::class, 'destroy'])->name('admin.articles.destroy');

    Route::get('/admin/catalog', [CatalogController::class, 'index'])->name('admin.ukm');
    Route::post('/admin/catalog/store', [CatalogController::class, 'store'])->name('admin.ukm.store');
    Route::get('/admin/catalog/edit/{id}', [CatalogController::class, 'edit'])->name('admin.ukm.edit');
    Route::post('/admin/catalog/update', [CatalogController::class, 'update'])->name('admin.ukm.update');
    Route::get('/admin/catalog/delete/{id}', [CatalogController::class, 'destroy'])->name('admin.ukm.destroy');

    Route::get('/admin/ukm', [AdminUkmController::class, 'index'])->name('admin.ukm');
    Route::post('/admin/ukm/store', [AdminUkmController::class, 'store'])->name('admin.ukm.store');
    Route::get('/admin/ukm/edit/{id}', [AdminUkmController::class, 'edit'])->name('admin.ukm.edit');
    Route::post('/admin/ukm/update', [AdminUkmController::class, 'update'])->name('admin.ukm.update');
    Route::get('/admin/ukm/delete/{id}', [AdminUkmController::class, 'destroy'])->name('admin.ukm.destroy');

    Route::get('/admin/tags', [AdminTagController::class, 'index'])->name('admin.tags');
    Route::post('/admin/tags/store', [AdminTagController::class, 'store'])->name('admin.tags.store');
    Route::get('/admin/tags/edit/{id}', [AdminTagController::class, 'edit'])->name('admin.tags.edit');
    Route::post('/admin/tags/update', [AdminTagController::class, 'update'])->name('admin.tags.update');
    Route::get('/admin/tags/delete/{id}', [AdminTagController::class, 'destroy'])->name('admin.tags.destroy');

    Route::get('/admin/sliders', [SliderController::class, 'index'])->name('admin.sliders');
    Route::get('/admin/sliders/edit/{id}', [SliderController::class, 'edit'])->name('admin.sliders.edit');
    Route::post('/admin/sliders/update', [SliderController::class, 'update'])->name('admin.sliders.update');
    Route::post('/admin/sliders/store', [SliderController::class, 'store'])->name('admin.sliders.store');
    Route::get('/admin/sliders/delete/{id}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');
});

require __DIR__.'/auth.php';
