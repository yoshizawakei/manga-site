<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// トップページ
Route::get('/', [MangaController::class, 'index'])
    ->name('top.index');


// お問い合わせ
Route::get('/contact', [ContactController::class, 'showForm'])
    ->name('top.contact');

Route::post('/contact', [ContactController::class, 'submitForm'])
    ->name('top.submitContact');


// 静的ページ
Route::get('/site-policy', [PageController::class, 'sitePolicy'])
    ->name('top.sitePolicy');

Route::get('/disclaimer', [PageController::class, 'disclaimer'])
    ->name('top.disclaimer');

Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])
    ->name('top.privacyPolicy');

Route::get('/profile', [PageController::class, 'profile'])
    ->name('top.profile');


// タグ
Route::get('/tags', [TagController::class, 'index'])
    ->name('tags.index');

Route::get('/tags/{tagName}', [TagController::class, 'show'])
    ->name('tags.show');


// 検索
Route::get('/search', [TagController::class, 'show'])
    ->name('search.results');


// サイトマップ
Route::get('/sitemap.xml', [SitemapController::class, 'index'])
    ->name('sitemap');


// 記事詳細
Route::get('/post/{id}', [MangaController::class, 'show'])
    ->name('post.show');


// ========================
// 管理画面（未認証）
// ========================

Route::get('/admin/login', [AdminController::class, 'login'])
    ->name('admin.login');

Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])
    ->name('admin.authenticate');

Route::post('/admin/logout', [AdminController::class, 'logout'])
    ->name('admin.logout');


// ========================
// 管理画面（認証必要）
// ========================

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ダッシュボード
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        // コンテンツ管理
        Route::get('/contents/create', [AdminController::class, 'create'])
            ->name('contents.create');

        Route::post('/contents', [AdminController::class, 'store'])
            ->name('contents.store');

        Route::get('/contents/{content}/edit', [AdminController::class, 'edit'])
            ->name('contents.edit');

        Route::put('/contents/{content}', [AdminController::class, 'update'])
            ->name('contents.update');

        Route::delete('/contents/{content}', [AdminController::class, 'destroy'])
            ->name('contents.destroy');

        // お問い合わせ管理
        Route::get('/inquiries/{inquiry}', [AdminController::class, 'showInquiry'])
            ->name('inquiries.show');

        Route::delete('/inquiries/{inquiry}', [ContactController::class, 'destroyInquiry'])
            ->name('inquiries.destroy');
    });