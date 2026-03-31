<?php
// app/Http/Controllers/Web/PageController.php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function about()
    {
        return view('front.about');
    }
}
