<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // Membuat pengguna
    $users = [
        [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),
            'role' => 'user',
        ],
        [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ],
        [
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('user2'),
            'role' => 'user',
        ],
        [
            'name' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('admin2'),
            'role' => 'admin',
        ]
    ];

    foreach ($users as $user) {
        User::create($user);
    }

    // Membuat produk
    $products = [
        [
            'nama' => 'Nasi Goreng',
            'jenis' => 'Makanan Utama',
            'harga' => 25000,
            'gambar' => 'nasi_goreng.jpg',
        ],
        [
            'nama' => 'Mie Goreng',
            'jenis' => 'Makanan Utama',
            'harga' => 20000,
            'gambar' => 'mie_goreng.jpg',
        ],
        [
            'nama' => 'Sate Ayam',
            'jenis' => 'Makanan Utama',
            'harga' => 30000,
            'gambar' => 'sate_ayam.jpg',
        ],
        [
            'nama' => 'Es Teh Manis',
            'jenis' => 'Minuman',
            'harga' => 5000,
            'gambar' => 'es_teh_manis.jpg',
        ],
        [
            'nama' => 'Es Jeruk',
            'jenis' => 'Minuman',
            'harga' => 8000,
            'gambar' => 'es_jeruk.jpg',
        ]
    ];

    foreach ($products as $product) {
        Product::create($product);
    }
}

    
    }
