<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    // Menentukan nama tabel yang terkait dengan model ini
    protected $table = 'products';

    // Menentukan kolom-kolom yang boleh diisi secara massal (mass assignable)
    protected $fillable = [
        'nama',
        'jenis',
        'harga',
        'gambar',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class);  // Setiap produk milik satu order
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    // Jika kamu ingin menggunakan timestamp secara otomatis
    public $timestamps = true;
}
