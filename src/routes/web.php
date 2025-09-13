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




// AdminController関連のルート設定
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');

// ログインが必要なルートグループ
Route::middleware(['auth'])->group(function () {
    // ここに認証が必要なルートを追加
    // コンテンツ作成フォームを表示するルート
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');

    // コンテンツを新規作成するルート (POST)
    Route::post("/admin/index", [AdminController::class, "store"])->name("admin.store");

    // ダッシュボードを表示するルート (コンテンツ一覧を含む)
    Route::get("/admin/dashboard", [AdminController::class, "dashboard"])->name("admin.dashboard");


    // 編集フォームを表示・更新するルート
    Route::get('/admin/index/{content}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/index/{content}', [AdminController::class, 'update'])->name('admin.update');

    // 削除するルート
    Route::delete('/admin/index/{content}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // お問い合わせ詳細画面を表示するルート
    Route::get('/admin/inquiries/{inquiry}', [ContactController::class, 'showInquiry'])->name('admin.inquiries.show');
});


