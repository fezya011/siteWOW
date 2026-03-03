<?php

namespace App\Http\Controllers;

class PageController // Контроллер для статики
{
    public function about()
    {
        return view('front.about');
    }
}
