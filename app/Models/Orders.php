<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'orders';

    // Atribut yang dapat diisi (Mass Assignment)
    protected $fillable = [
        'user_id',
        'order_status',
        'total_harga',
    ];

    // Relasi: Order ini dimiliki oleh seorang User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Order ini memiliki banyak OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

}
