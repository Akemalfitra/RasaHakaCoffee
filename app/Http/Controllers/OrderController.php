<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Orders;
use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request) {
        // Validasi input
        // $request->validate([
        //     'userId' => 'required',
        //     'cart' => 'required|array',
        //     'cart.*.productId' => 'required|exists:products,id',  // Validasi productId yang valid
        //     'cart.*.quantity' => 'required|integer|min:1',
        //     'jumlah' => 'required|integer|min:0',
        // ]);

          // Membuat order baru
        $order = Orders::create([
            'user_id' => $request->input('userId'),
            'order_status' => 'pending',
            'total_harga' => $request->input('jumlah') // Awalnya total amount 0, akan dihitung nanti
        ]);

        // Insert item ke tabel order_items
        // Menambahkan order items
        foreach ($request->input("cart") as $item) {
            $product = Product::find($item['productId']);
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'harga' => $item['harga'],
            ]);
        }

        return response()->json([
            'message' => 'Order berhasil dibuat',
        ], 201);
    }
    
    public function getPesanan() {
        
        $user_id = Auth::id(); // Mengambil ID pengguna yang sedang login

        // Ambil pesanan berdasarkan user_id
        $pesanan = Orders::where('user_id', $user_id)->get();

        // Kelompokkan berdasarkan tanggal 'created_at' (hanya tanggalnya saja)
        $groupedPesanan = $pesanan->groupBy(function($item) {
            return $item->created_at->toDateString(); // Mengambil hanya tanggal
        });

        // Kirimkan data yang sudah dikelompokkan ke tampilan Inertia
        return Inertia::render('Pesanan', [
            'pesanan' => $groupedPesanan,
        ]);
    }

    public function batalkanPesanan(Request $request) {

         // Validasi ID pesanan
        $request->validate([
            // 'id' => 'required|exists:orders,id', // Validasi ID pesanan yang ada di database
        ]);

        try {
            // Temukan pesanan berdasarkan ID
            $pesanan = Orders::findOrFail($request->id);

            // Ubah status pesanan menjadi 'dibatalkan'
            $pesanan->delete();

            // Mengembalikan response sukses ke frontend
            return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dibatalkan');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return redirect()->route('pesanan')->with('error', 'Terjadi kesalahan saat membatalkan pesanan');
        }
    }
}
