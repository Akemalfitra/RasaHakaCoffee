<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
      
    // Validasi input
    $request->validate([
        'userId' => 'required|exists:users,id',
        'cart' => 'required|array',
        'cart.*.productId' => 'required|exists:products,id',  // Validasi productId yang valid
        'cart.*.quantity' => 'required|integer|min:1',
        'jumlah' => 'required|integer|min:0',
    ]);

    // Buat order baru
    $order = Orders::create([
        'user_id' => $request->input('userId'),  // Ambil userId dari request
        'jumlah' => $request->input('jumlah'),   // Ambil jumlah total dari request
    ]);

    // Insert item ke tabel order_items
    foreach ($request->input('cart') as $cartItem) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cartItem['productId'],  // Gunakan 'product_id' sesuai konvensi Laravel
            'quantity' => $cartItem['quantity'],
        ]);
    }

    return response()->json([
        'message' => 'Order berhasil dibuat',
        'order' => $order
    ], 201);
    }
}
