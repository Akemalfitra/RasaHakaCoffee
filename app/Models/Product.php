<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{

    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'nama',
        'jenis',
        'harga',
        'gambar',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class); 
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    // Jika kamu ingin menggunakan timestamp secara otomatis
    public $timestamps = true;
}
