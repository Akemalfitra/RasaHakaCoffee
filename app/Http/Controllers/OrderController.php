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
        $order = Orders::create([
            'user_id' => $request->input('userId'),
            'order_status' => 'pending',
            'total_harga' => $request->input('jumlah') 
        ]);

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
        
        $user_id = Auth::id(); 

        // Ambil pesanan berdasarkan user_id
        $pesanan = Orders::with('user')->where('user_id', $user_id)->get();

        // Kelompokkan berdasarkan tanggal 'created_at' (hanya tanggalnya saja)
        $groupedPesanan = $pesanan->groupBy(function($item) {
            return $item->created_at->toDateString(); // Mengambil hanya tanggal
        });

        // Kirimkan data yang sudah dikelompokkan ke tampilan Inertia
        return Inertia::render('Pesanan', [
            'pesanan' => $groupedPesanan,
            'route' => ['rincian', 'user.pesanan.batalkan']
        ]);
    }

    public function batalkanPesanan(Request $request) {

        try {
            // Temukan pesanan berdasarkan ID
            $pesanan = Orders::findOrFail($request->id);

            // Ubah status pesanan menjadi 'dibatalkan'
            $pesanan->order_status = 'Dibatalkan pembeli';
            
            $pesanan->save(); // Simpan perubahan ke database

            // Mengembalikan response sukses ke frontend
            return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dibatalkan');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return redirect()->route('pesanan')->with('error', 'Terjadi kesalahan saat membatalkan pesanan');
        }
    }

    public function rincianPesanan(Request $request) {
        $order_id = $request->id;
   
        $pesanan = OrderItems::with('product')  // Melakukan eager loading pada relasi 'product'
        ->where('order_id', $order_id)      // Menyaring berdasarkan order_id
        ->get();

        return Inertia::render('Rincian', [
        'pesanan' => $pesanan,
        ]);
    }
}
