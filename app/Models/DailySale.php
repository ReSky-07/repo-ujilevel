<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailySale extends Model
{
    protected $fillable = ['sale_date', 'product_id', 'quantity'];
    protected $casts = ['sale_date' => 'date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getRemainingStockAttribute()
    {
        $totalSold = $this->product->sales()
            ->whereDate('sale_date', $this->sale_date)
            ->sum('quantity');

        return $this->quantity - $totalSold;
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'product_id', 'product_id')
            ->whereDate('sale_date', $this->sale_date);
    }
}
