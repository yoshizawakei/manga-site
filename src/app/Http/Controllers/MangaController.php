<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DmmApiService;

class MangaController extends Controller
{
    public function index()
    {
        return view("index");
    }

    // protected DmmApiService $dmmApiService;

    // public function __construct(DmmApiService $dmmApiService)
    // {
    //     $this->dmmApiService = $dmmApiService;
    // }

    // public function top(Request $request)
    // {
    //     $keyword = $request->input('keyword');
    //     $mangas = [];

    //     if ($keyword) {
    //         $mangas = $this->dmmApiService->searchManga($keyword);
    //     }

    //     return view('manga.dmm-top', [
    //         'mangas' => $mangas,
    //     ]);
    // }

}
