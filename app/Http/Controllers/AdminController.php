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
            'route' => ["rincian.admin", "admin.pesanan.batalkan", "admin.pesanan.proses", "admin.pesanan.selesai", "admin.pesanan.hapus" ]
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
            $pesanan->order_status = 'Dibatalkan penjual';
            
            $pesanan->save(); // Simpan perubahan ke database

            // Mengembalikan response sukses ke frontend
            return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil dibatalkan');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return redirect()->route('admin.dashboard')->with('error', 'Terjadi kesalahan saat membatalkan pesanan');
        }
    }
    
    public function prosesPesanan(Request $request) {

        try {

            // Temukan pesanan berdasarkan ID
            $pesanan = Orders::findOrFail($request->id);

            // Ubah status pesanan menjadi 'dibatalkan'
            $pesanan->order_status = 'Pesanan diproses';
            
            $pesanan->save(); // Simpan perubahan ke database

            // Mengembalikan response sukses ke frontend
            return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil dibatalkan');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return redirect()->route('admin.dashboard')->with('error', 'Terjadi kesalahan saat membatalkan pesanan');
        }
    }
    
    public function selesaiPesanan(Request $request) {

        try {

            // Temukan pesanan berdasarkan ID
            $pesanan = Orders::findOrFail($request->id);

            // Ubah status pesanan menjadi 'dibatalkan'
            $pesanan->order_status = 'Pesanan selesai';
            
            $pesanan->save(); // Simpan perubahan ke database

            // Mengembalikan response sukses ke frontend
            return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil dibatalkan');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return redirect()->route('admin.dashboard')->with('error', 'Terjadi kesalahan saat membatalkan pesanan');
        }
    }
    
    public function hapusPesanan(Request $request) {

        try {

            // Temukan pesanan berdasarkan ID
            $pesanan = Orders::findOrFail($request->id);

            // Ubah status pesanan menjadi 'dibatalkan'
            $pesanan->delete();
            
            $pesanan->save(); // Simpan perubahan ke database

            // Mengembalikan response sukses ke frontend
            return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil dibatalkan');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return redirect()->route('admin.dashboard')->with('error', 'Terjadi kesalahan saat membatalkan pesanan');
        }
    }

    public function editPesanan(Request $request) {

        $id = $request->id;

        $product = Product::where('id', $id)->get();

        return Inertia::render('AdminEditProducts', ['product' => $product]);
    }
}
