<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Support\Str;
use Abraham\TwitterOAuth\TwitterOAuth;

class Content extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'body',
        'image_url',
        'content_url',
        'status',
    ];

    public function getMarkDownBodyAttribute()
    {
        if (is_null($this->body)) {
            return '';
        }

        $converter = new CommonMarkConverter([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
        ]);

        return $converter->convert($this->body)->getContent();
    }

    protected static function booted()
    {
        // 保存前：英数字タイトルなら自動スラッグ生成
        static::creating(function ($content) {
            if (empty($content->slug)) {
                $slug = Str::slug($content->title);
                if (!empty($slug)) {
                    $content->slug = static::generateUniqueSlug($slug);
                }
            }
        });

        // 作成後：日本語タイトル等でスラッグ未生成の場合はIDベースで補完
        static::created(function ($content) {
            if (empty($content->slug)) {
                $content->slug = 'post-' . $content->id;
                $content->saveQuietly();
            }

            if ($content->status !== self::STATUS_PUBLISHED) {
                return;
            }

            try {
                $url = route('post.show', $content->slug);
                $title = mb_strimwidth($content->title, 0, 100, "...");
                $status = "【記事を更新しました】\n\n" . $title . "\n" . $url . "\n\n" . "#元公務員 #30代の挑戦 #副業";

                $connection = new TwitterOAuth(
                    env('X_API_KEY'),
                    env('X_API_KEY_SECRET'),
                    env('X_ACCESS_TOKEN'),
                    env('X_ACCESS_TOKEN_SECRET')
                );

                $connection->setApiVersion('2');
                $connection->post("tweets", ["text" => $status]);

                \Log::info('X自動投稿レスポンス', [
                    'http_code' => $connection->getLastHttpCode(),
                    'body' => $connection->getLastBody(),
                ]);

            } catch (\Exception $e) {
                \Log::error('X自動投稿エラー: ' . $e->getMessage());
            }
        });
    }

    private static function generateUniqueSlug(string $base): string
    {
        $slug = $base;
        $count = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $count++;
        }
        return $slug;
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
