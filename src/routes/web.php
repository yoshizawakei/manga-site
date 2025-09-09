<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\AdminController;
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

//MangaController関連のルート設定
Route::get('/', [MangaController::class, 'index'])->name('top.index');



// AdminController関連のルート設定
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');

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
Route::get('/admin/inquiries/{inquiry}', [AdminController::class, 'showInquiry'])->name('admin.inquiries.show');