<?php

namespace App\Http\Controllers;

use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        // 5 paket yang tampil di beranda (urut dari kecepatan terendah).
        $featured = Product::where('is_featured', true)->orderBy('speed_mbps')->take(5)->get();

        return view('pages.home', compact('featured'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
