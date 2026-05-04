<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Tambahkan baris protected $fillable ini:
    protected $fillable = ['name', 'slug', 'price', 'stock', 'category', 'description', 'image'];
}