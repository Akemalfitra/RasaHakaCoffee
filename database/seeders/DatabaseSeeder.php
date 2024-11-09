<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => 'user'
        ]);

        Product::factory()->createMany([
            [
                'nama' => 'Nasi Goreng',
                'jenis' => 'Makanan Utama',
                'stok' => 50,
                'harga' => 25000,
                'gambar' => 'nasi_goreng.jpg', 
            ],
            [
                'nama' => 'Mie Goreng',
                'jenis' => 'Makanan Utama',
                'stok' => 40,
                'harga' => 20000,
                'gambar' => 'mie_goreng.jpg',
            ],
            [
                'nama' => 'Sate Ayam',
                'jenis' => 'Makanan Utama',
                'stok' => 30,
                'harga' => 30000,
                'gambar' => 'sate_ayam.jpg',
            ],
            [
                'nama' => 'Es Teh Manis',
                'jenis' => 'Minuman',
                'stok' => 100,
                'harga' => 5000,
                'gambar' => 'es_teh_manis.jpg',
            ],
            [
                'nama' => 'Es Jeruk',
                'jenis' => 'Minuman',
                'stok' => 80,
                'harga' => 8000,
                'gambar' => 'es_jeruk.jpg',
            ],
        ]);
    
    }
}
