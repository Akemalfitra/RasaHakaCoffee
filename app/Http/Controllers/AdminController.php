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
            'route' => "rincian.admin",
            'batalkan' => 'admin.pesanan.batalkan'
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

    public function batalkanPesanan(Request $request) {

        try {

            // Temukan pesanan berdasarkan ID
            $pesanan = Orders::findOrFail($request->id);

            // Ubah status pesanan menjadi 'dibatalkan'
            $pesanan->order_status = 'dibatalkan penjual';
            
            $pesanan->save(); // Simpan perubahan ke database

            // Mengembalikan response sukses ke frontend
            return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil dibatalkan');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return redirect()->route('admin.dashboard')->with('error', 'Terjadi kesalahan saat membatalkan pesanan');
        }
    }
}
