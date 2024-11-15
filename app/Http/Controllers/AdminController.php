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

    public function hapusMenu(Request $request) {

        // Temukan pesanan berdasarkan ID dan hapus
        $pesanan = Product::find($request->id);

        if ($pesanan) {
            // Jika pesanan ditemukan, hapus
            $pesanan->delete();

            // Mengembalikan response sukses ke frontend
            return redirect()->route('admin.products')->with('success', 'Pesanan berhasil dibatalkan');
        }

        // Jika pesanan tidak ditemukan, kembalikan response error
        return redirect()->route('admin.products')->with('error', 'Pesanan tidak ditemukan');

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

    // $request->validate([
    //     'nama' => 'required|string|max:255',
    //     'jenis' => 'required|string|max:255',
    //     'stok' => 'required|integer',
    //     'harga' => 'required|numeric',
    //     'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // Validasi foto
    // ]);

    // Upload foto ke server
    if ($request->hasFile('gambar')) {
        // Mendapatkan ekstensi file
        $extension = $request->gambar->getClientOriginalExtension();
        // Membuat nama file baru dengan hash
        $fileName = md5(time()) . '.' . $extension;

        // Menentukan folder tujuan
        $folder = '/products';

        // Cek apakah folder ada, jika tidak ada maka buat folder tersebut
        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder);
        }

        // Simpan file ke folder yang sudah ditentukan
        $request->gambar->storeAs($folder, $fileName);
        
    }

    // Simpan data ke database
    Product::create([
        'nama' => $request->nama,
        'jenis' => $request->jenis,
        'harga' => $request->harga,
        'gambar' => $fileName ?? null, // Menyimpan path foto
    ]);

    // Cek apakah data berhasil disimpan dan redirect atau response
    return redirect()->route('admin.viewTambah.products')->with('success', 'Menu berhasil ditambahkan.');
    }
}
