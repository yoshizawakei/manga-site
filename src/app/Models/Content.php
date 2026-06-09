<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Support\Facades\Crypt;
use Abraham\TwitterOAuth\TwitterOAuth;

class Content extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 'draft';       // 非公開・下書き
    const STATUS_PUBLISHED = 'published'; // 公開

    protected $fillable = [
        'title',
        'description',
        'body',
        'image_url',
        'content_url',
        'status',
    ];

    public function getMarkDownBodyAttribute()
    {
        // 1. bodyがnull（または未設定）なら、変換せずに空文字を返す
        if (is_null($this->body)) {
            return '';
        }

        $converter = new CommonMarkConverter([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
        ]);

        // 2. 文字列であることが確定してから変換を実行
        return $converter->convert($this->body)->getContent();
    }

    public function getEncryptedIdAttribute()
    {
        return Crypt::encryptString($this->id);
    }

    /**
     * モデルのブート処理。重複を解消し1つに統合しました。
     */
    protected static function booted()
    {
        static::created(function ($content) {
            // ★ 非公開（下書き）の場合はXへの自動投稿をスキップ
            if ($content->status !== self::STATUS_PUBLISHED) {
                return;
            }

            try {
                $url = route('post.show', $content->encrypted_id);
                $title = mb_strimwidth($content->title, 0, 100, "...");
                $status = "【記事を更新しました】\n\n" . $title . "\n" . $url . "\n\n" . "#元公務員 #30代の挑戦 #副業";

                $connection = new TwitterOAuth(
                    env('X_API_KEY'),
                    env('X_API_KEY_SECRET'),
                    env('X_ACCESS_TOKEN'),
                    env('X_ACCESS_TOKEN_SECRET')
                );

                $connection->setApiVersion('2');
                $result = $connection->post("tweets", ["text" => $status]);

                // ★デバッグ用ログを追加：成功・失敗問わずレスポンスを残す
                \Log::error('X_DEBUG_RESPONSE', [
                    'http_code' => $connection->getLastHttpCode(),
                    'body' => $connection->getLastBody(),
                ]);

            } catch (\Exception $e) {
                \Log::error('X自動投稿エラー: ' . $e->getMessage());
            }
        });

        // (任意) もし「下書き」から「公開」に"更新"した際にも自動投稿したい場合は、
        // ここに static::updated(function ($content) { ... }) を追記できます。
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}