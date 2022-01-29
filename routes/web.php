<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UkmController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\AdminTagController;
use App\Http\Controllers\AdminUkmController;
use App\Http\Controllers\CategoryController;
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
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('/kemitraan', [ContactController::class, 'index'])->name('contact');

Route::get('/search', [IndexController::class, 'search'])->name('search');

Route::get('/katalog/{slug}', [CatalogController::class, 'show'])->name('catalog.show');
Route::get('/katalog/filter', [CatalogController::class, 'filter'])->name('catalog.filter');
Route::get('/katalog-click/floating-click', [CatalogController::class, 'floating'])->name('catalog.floating');
Route::get('/ukm/{slug}', [UkmController::class, 'show'])->name('ukm.show');
Route::get('/ukm-click/whatsapp-click', [UkmController::class, 'whatsapp'])->name('ukm.whatsapp');
Route::get('/ukm-click/instagram-click', [UkmController::class, 'instagram'])->name('ukm.instagram');

Route::get('/berita', [ArticleController::class, 'index'])->name('article.index');
Route::get('/berita/{slug}', [ArticleController::class, 'show'])->name('article.show');

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:administrator'])->group(function (){
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/upload/image', [AdminArticleController::class, 'upload'])->name('admin.upload.image');

    Route::get('/admin/article', [AdminArticleController::class, 'index'])->name('admin.article');
    Route::post('/admin/article/store', [AdminArticleController::class, 'store'])->name('admin.article.store');
    Route::get('/admin/article/edit/{id}', [AdminArticleController::class, 'edit'])->name('admin.article.edit');
    Route::post('/admin/article/update', [AdminArticleController::class, 'update'])->name('admin.article.update');
    Route::get('/admin/article/delete/{id}', [AdminArticleController::class, 'destroy'])->name('admin.article.destroy');

    Route::get('/admin/catalog', [CatalogController::class, 'index'])->name('admin.catalog');
    Route::post('/admin/catalog/store', [CatalogController::class, 'store'])->name('admin.catalog.store');
    Route::get('/admin/catalog/edit/{id}', [CatalogController::class, 'edit'])->name('admin.catalog.edit');
    Route::post('/admin/catalog/update', [CatalogController::class, 'update'])->name('admin.catalog.update');
    Route::get('/admin/catalog/delete/{id}', [CatalogController::class, 'destroy'])->name('admin.catalog.destroy');

    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/admin/category/update', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    Route::get('/admin/ukm', [AdminUkmController::class, 'index'])->name('admin.ukm');
    Route::post('/admin/ukm/store', [AdminUkmController::class, 'store'])->name('admin.ukm.store');
    Route::get('/admin/ukm/edit/{ukm}', [AdminUkmController::class, 'edit'])->name('admin.ukm.edit');
    Route::post('/admin/ukm/update', [AdminUkmController::class, 'update'])->name('admin.ukm.update');
    Route::get('/admin/ukm/delete/{ukm}', [AdminUkmController::class, 'destroy'])->name('admin.ukm.destroy');
    Route::get('getSubdistrict',[AdminUkmController::class, 'getSubdistrict'])->name('admin.ukm.getSubdistrict');
    Route::get('getCity',[AdminUkmController::class, 'getCity'])->name('admin.ukm.getCity');

    Route::get('/admin/tags', [AdminTagController::class, 'index'])->name('admin.tags');
    Route::post('/admin/tags/store', [AdminTagController::class, 'store'])->name('admin.tags.store');
    Route::get('/admin/tags/edit/{id}', [AdminTagController::class, 'edit'])->name('admin.tags.edit');
    Route::post('/admin/tags/update', [AdminTagController::class, 'update'])->name('admin.tags.update');
    Route::get('/admin/tags/delete/{id}', [AdminTagController::class, 'destroy'])->name('admin.tags.destroy');

    Route::get('/admin/slider', [SliderController::class, 'index'])->name('admin.slider');
    Route::post('/admin/slider/store', [SliderController::class, 'store'])->name('admin.slider.store');
    Route::get('/admin/slider/edit/{id}', [SliderController::class, 'edit'])->name('admin.slider.edit');
    Route::post('/admin/slider/update', [SliderController::class, 'update'])->name('admin.slider.update');
    Route::get('/admin/slider/delete/{id}', [SliderController::class, 'destroy'])->name('admin.slider.destroy');

    Route::get('/admin/sponsor', [SponsorController::class, 'index'])->name('admin.sponsor');
    Route::post('/admin/sponsor/store', [SponsorController::class, 'store'])->name('admin.sponsor.store');
    Route::get('/admin/sponsor/edit/{id}', [SponsorController::class, 'edit'])->name('admin.sponsor.edit');
    Route::post('/admin/sponsor/update', [SponsorController::class, 'update'])->name('admin.sponsor.update');
    Route::get('/admin/sponsor/delete/{id}', [SponsorController::class, 'destroy'])->name('admin.sponsor.destroy');
});

require __DIR__.'/auth.php';
