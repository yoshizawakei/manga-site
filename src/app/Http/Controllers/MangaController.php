<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;


class MangaController extends Controller
{
    public function index()
    {
        $contents_latest = Content::orderBy('created_at', 'desc')->take(9)->get();

        $contents_all = Content::orderBy('views', 'desc')->get();

        return view("index", compact('contents_latest', 'contents_all'));
    }

}
