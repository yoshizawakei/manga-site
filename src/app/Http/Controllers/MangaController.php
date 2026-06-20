<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Tag;

class MangaController extends Controller
{
    public function index()
    {
        $contents_all = Content::where('status', Content::STATUS_PUBLISHED)
            ->latest()
            ->paginate(12);

        $contents_latest = Content::where('status', Content::STATUS_PUBLISHED)
            ->latest()
            ->take(5)
            ->get();

        $tags = Tag::has('contents')->withCount('contents')->orderBy('contents_count', 'desc')->take(30)->get();

        return view('index', compact('contents_all', 'contents_latest', 'tags'));
    }

    public function show($slug)
    {
        $content = Content::where('status', Content::STATUS_PUBLISHED)
            ->where('slug', $slug)
            ->with('tags')
            ->firstOrFail();

        $contents_latest = Content::where('status', Content::STATUS_PUBLISHED)
            ->latest()
            ->take(5)
            ->get();

        $tags = Tag::has('contents')->withCount('contents')->orderBy('contents_count', 'desc')->take(30)->get();

        return view('show', compact('content', 'contents_latest', 'tags'));
    }
}
