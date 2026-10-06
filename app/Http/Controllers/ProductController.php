<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('katalog', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return view('detail', compact('product'));
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function berhasil()
    {
        return view('berhasil');
    }
}