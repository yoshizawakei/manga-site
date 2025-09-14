<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

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

//  トップページ
Route::get('/', [MangaController::class, 'index'])->name('top.index');

// お問い合わせ関連
Route::get("/contact", [ContactController::class, "showForm"])->name("top.contact");
Route::post("/contact", [ContactController::class, "submitForm"])->name("top.submitContact");

// 静的ページ関連
Route::get("/site-policy", [PageController::class, "sitePolicy"])->name("top.sitePolicy");
Route::get("/disclaimer", [PageController::class, "disclaimer"])->name("top.disclaimer");
Route::get("/privacy-policy", [PageController::class, "privacyPolicy"])->name("top.privacyPolicy");

// タグ関連
Route::get("/tags", [TagController::class, "index"])->name("tags.index");
// タグ詳細ページ (タグ名で表示)
Route::get("/tags/{tagName}", [TagController::class, "show"])->name("tags.show");
// 検索結果ページ (検索クエリで表示)
Route::get('/search', [TagController::class, 'show'])->name('search.results');


// ---
// AdminController関連のルート設定
// 認証が必要ないルート (ログイン・ログアウト)
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


// ---
// 認証が必要な管理者ルートのグループ化
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // ダッシュボード
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // コンテンツ管理（リソースフルルート）
    // 'create', 'store', 'edit', 'update', 'destroy' の各アクションに対応
    // 'index' アクションはダッシュボードとして利用
    Route::get('/contents/create', [AdminController::class, 'create'])->name('contents.create');
    Route::post('/contents', [AdminController::class, 'store'])->name('contents.store');
    Route::get('/contents/{content}/edit', [AdminController::class, 'edit'])->name('contents.edit');
    Route::put('/contents/{content}', [AdminController::class, 'update'])->name('contents.update');
    Route::delete('/contents/{content}', [AdminController::class, 'destroy'])->name('contents.destroy');

    // お問い合わせ管理
    Route::get('/inquiries/{inquiry}', [AdminController::class, 'showInquiry'])->name('inquiries.show');
});