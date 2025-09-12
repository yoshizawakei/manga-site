<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(20),
            'description' => $this->faker->realText(100),
            'image_url' => 'https://via.placeholder.com/200x280.png?text=' . urlencode($this->faker->word),
            'content_url' => $this->faker->url,
            'views' => $this->faker->numberBetween(100, 5000),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Content $content) {
            // ランダムなタグ名を定義
            $tagNames = collect(['恋愛', 'コメディ', 'ファンタジー', 'アクション']);

            // 1〜3個のタグをランダムに取得し、`tags`テーブルに存在しない場合は作成
            $tagsToAttach = $tagNames->random(rand(1, 3))->map(function ($tagName) {
                return Tag::firstOrCreate(['name' => $tagName]);
            });

            // `Tag`モデルのコレクションから`id`のリストを抽出
            $tagIds = $tagsToAttach->pluck('id')->all();

            // コンテンツとタグを中間テーブルで正しく紐付ける
            $content->tags()->attach($tagIds);
        });
    }
}