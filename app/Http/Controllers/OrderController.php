<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        dd($request);
        // Validasi data cart
        $request->validate([
            'cart' => 'required|array',
            'cart.*.id' => 'required|integer',
            'cart.*.name' => 'required|string',
            'cart.*.price' => 'required|numeric',
        ]);

        // Menyimpan order
        // $order = Order::create([
        //     'total' => collect($request->cart)->sum('price'),
        //     'status' => 'pending',
        // ]);

        // // Menyimpan order items
        // foreach ($request->cart as $item) {
        //     OrderItem::create([
        //         'order_id' => $order->id,
        //         'product_id' => $item['id'],
        //         'name' => $item['name'],
        //         'price' => $item['price'],
        //     ]);
        // }

        // Mengembalikan respons sukses
        return response()->json(['success' => true]);
    }
}
