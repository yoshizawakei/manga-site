<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /** 一括代入可能な属性
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * このタグに紐づくコンテンツを取得する
     */
    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }
}
