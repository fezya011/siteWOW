<?php
// app/Http/Controllers/Web/PageController.php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Show about page
     */
    public function about()
    {
        return view('front.about');
    }
}
