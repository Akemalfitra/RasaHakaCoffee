<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Orders;
use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {

        $pesanan = Orders::with("user")
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('OwnerDashboard', [
            'pesanan' => $pesanan
        ]);
    }

    public function getProducts(Request $request)
    {

        $Product = Product::all();

        return Inertia::render('OwnerProducts', [
            'Product' => $Product
        ]);
    }

    public function rincianPesanan(Request $request)
    {
        $id = $request->id;

        $order = Orders::where('id', $id)->get();

        $pesanan = OrderItems::with('product')->where('order_id', $id)->get();

        return Inertia::render('OwnerRincian', [
            'pesanan' => $pesanan,
            'order' => $order
        ]);
    }

    public function getPenjualan(Request $request)
    {
        $pesanan = Orders::with("user")
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('OwnerPenjualan', [
            'pesanan' => $pesanan
        ]);
    }
}
