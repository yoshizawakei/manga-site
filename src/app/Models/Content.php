<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use League\CommonMark\CommonMarkConverter;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'body',
        'image_url',
        'content_url',
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


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}