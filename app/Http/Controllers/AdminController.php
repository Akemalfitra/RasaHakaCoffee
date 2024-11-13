<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Orders;
use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {

        $pesanan = Orders::with("user")->get();

        return Inertia::render('AdminDashboard', [
            'pesanan' => $pesanan,
            'route' => "rincian.admin"
        ]);
        
    }

    public function rincianPesanan(Request $request) {

        $user_id = $request->id;
        
        $pesanan = Orders::with('user')->get();
        
        $pesanan = OrderItems::with('product')->where('order_id', $user_id)->get();

        return Inertia::render('AdminRincian', [
        'pesanan' => $pesanan,
        ]);
    }

    public function getProducts(Request $request) {

        $Product = Product::all();

        return Inertia::render('AdminProducts', [
            'Product' => $Product
        ]);
    }
}
