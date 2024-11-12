<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    Public function getMenu() {
    // Ambil data produk dari database
        $products = Product::all();

        // Kirim data ke halaman Vue menggunakan Inertia
        return Inertia::render('Dashboard', [
            'products' => $products,
        ]);
    }

    public function redirect() {
        return redirect("menu");
    }
}
