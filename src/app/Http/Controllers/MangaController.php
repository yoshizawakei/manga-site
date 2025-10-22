<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Tag;

class MangaController extends Controller
{
    public function index()
    {
        $contents_latest = Content::with("tags")->orderBy('created_at', 'desc')->take(12)->get();
        $contents_all = Content::with("tags")->inRandomOrder()->paginate(12);
        $tags = Tag::inRandomOrder()->take(30)->get();

        return view("index", compact('contents_latest', 'contents_all', 'tags'));
    }
}