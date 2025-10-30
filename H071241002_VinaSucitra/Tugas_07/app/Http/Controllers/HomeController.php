<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View {
        return view('home');
    }

    public function destinasi(): View {
        return view('destinasi');
    }

    public function kuliner(): View {
        return view('kuliner');
    }

    public function galeri(): View {
        return view('galeri');
    }

    public function adat(): View {
        return view('adat');
    }

    public function kontak(): View {
        return view('kontak');
    }


}

