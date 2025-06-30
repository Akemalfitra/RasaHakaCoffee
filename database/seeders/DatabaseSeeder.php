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
                'nama' => 'Spanish Choco',
                'jenis' => 'non-coffee',
                'harga' => 18000,
                'gambar' => 'spanish-choco2.jpg',
            ],
            [
                'nama' => 'Spanish Berry',
                'jenis' => 'non-coffee',
                'harga' => 18000,
                'gambar' => 'spanish-berry2.jpg',
            ],
            [
                'nama' => 'Gayo Reserve Brew',
                'jenis' => 'coffee',
                'harga' => 28000,
                'gambar' => 'gayo-reserve-brew.jpg',
            ],
            [
                'nama' => 'Arabian Gold Latte',
                'jenis' => 'coffee',
                'harga' => 32000,
                'gambar' => 'arabian-gold-latte.jpg',
            ],
            [
                'nama' => 'Amber Cinnamon Flat White ',
                'jenis' => 'coffee',
                'harga' => 49000,
                'gambar' => 'amber-cinnamon-flat-white.jpg',
            ],
            [
                'nama' => 'Nitro Cold Brew',
                'jenis' => 'coffee',
                'harga' => 59000,
                'gambar' => 'nitro-cold-brew.jpg',
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
