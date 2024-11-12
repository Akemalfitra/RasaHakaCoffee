<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItems extends Model
{
   use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'order_items';

    // Atribut yang dapat diisi (Mass Assignment)
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'harga',
    ];

    // Relasi: OrderItem ini dimiliki oleh satu Order
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    // Relasi ke model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
