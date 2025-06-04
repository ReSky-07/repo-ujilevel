<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price'];

    // Cast price to float for better handling
    protected $casts = [
        'price' => 'float',
    ];

    public function dailySales()
    {
        return $this->hasMany(DailySale::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // Helper method untuk format harga
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}