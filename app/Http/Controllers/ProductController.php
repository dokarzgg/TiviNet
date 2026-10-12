<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Daftar paket: 5 produk per halaman -> 10 produk = 2 halaman (1, 2, Next).
     */
    public function index()
    {
        $products = Product::orderBy('speed_mbps')->paginate(5);

        return view('pages.products', compact('products'));
    }
}
