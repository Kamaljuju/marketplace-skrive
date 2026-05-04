<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'product_id', 'total_price', 'payment_method', 'address', 'status'];

    // Relasi ke Produk
    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function user() {
    return $this->belongsTo(\App\Models\User::class);
}
}