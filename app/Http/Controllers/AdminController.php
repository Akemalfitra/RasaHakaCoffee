<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Orders;
use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $id = $request->id;
    
        $order = Orders::where('id', $id)->get();
        
        $pesanan = OrderItems::with('product')->where('order_id', $id)->get();

        return Inertia::render('AdminRincian', [
        'pesanan' => $pesanan,
        'order' => $order
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

        // Temukan pesanan berdasarkan ID
        $pesanan = Orders::find($request->id);

        if ($pesanan) {
            // Ubah status pesanan menjadi 'Pesanan selesai'
            $pesanan->order_status = 'Pesanan selesai';
            
            $pesanan->save(); // Simpan perubahan ke database

            // Mengembalikan response sukses ke frontend
            return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil dibatalkan');
        } else {
            // Jika pesanan tidak ditemukan, kembalikan response error
            return redirect()->route('admin.dashboard')->with('error', 'Pesanan tidak ditemukan');
        }
    }
    
    public function hapusPesanan(Request $request) {

        $pesanan = Orders::find($request->id);

        if ($pesanan) {
            
            $pesanan->delete();

            return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil dibatalkan');

        } else {

            return redirect()->route('admin.dashboard')->with('error', 'Pesanan tidak ditemukan atau sudah dibatalkan');
        }

    }

    public function hapusMenu(Request $request) {

        $produk = Product::find($request->id);

        if ($produk) {
            
            if ($produk->gambar && Storage::exists('/img/products/' . $produk->gambar)) {
                Storage::delete('/img/products/' . $produk->gambar); 
            }

            $produk->delete();

            return redirect()->route('admin.products');
        }

           return redirect()->route('admin.products')->with('error', 'Menu gagal di hapus !');
    }

    public function editPesanan(Request $request) {

        $id = $request->id;

        $product = Product::where('id', $id)->get();

        return Inertia::render('AdminEditProducts', ['product' => $product]);
    }

    public function ViewTambahMenu() {

        return Inertia::render('AdminTambahProducts');
    }

    public function tambahMenu(Request $request) {

    // Validasi data yang diterima
    $request->validate([
        'nama' => 'required',
        'jenis' => 'required',
        'harga' => 'required',
        'gambar' => 'required', // Validasi foto
    ]);

    // Upload foto ke server
    if ($request->hasFile('gambar')) {
        
        $extension = $request->gambar->getClientOriginalExtension();
        
        $fileName = md5(time()) . '.' . $extension;

        $folder = ('/img/products');

        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder);
        }
        
        $request->gambar->storeAs($folder, $fileName);
        
    }

    Product::create([
        'nama' => $request->nama,
        'jenis' => $request->jenis,
        'harga' => $request->harga,
        'gambar' => $fileName ?? null,
    ]);

    return redirect()->route('admin.viewTambah.products');
    
    }
}
