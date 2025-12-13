<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.app', function ($view) {
            try {
                // タグを名前順、または人気順（必要に応じてcountなどでソート）で10件取得
                // ここでは仮に名前でソートして取得します。
                $tags = Tag::orderBy('name', 'asc')->limit(10)->get();
            } catch (\Exception $e) {
                // データベース接続エラーやテーブルがない場合のエラーを回避
                $tags = collect([]);
                // 開発環境ではエラーをログに記録
                if (app()->environment('local')) {
                    logger()->error("Failed to load tags for layout: " . $e->getMessage());
                }
            }

            // ビューに $tags 変数として渡す
            $view->with('tags', $tags);
        });
    }
}
