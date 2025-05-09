<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'tanggal_input',
        'nama_barang',
        'stok',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
