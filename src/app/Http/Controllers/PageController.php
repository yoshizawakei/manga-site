<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function sitePolicy()
    {
        return view("site_policy");
    }

    public function disclaimer()
    {
        return view("disclaimer");
    }

    public function privacyPolicy()
    {
        return view("privacy_policy");
    }
}