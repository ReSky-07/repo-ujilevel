<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'kategori_id',
        'jenis_transaksi',
        'jumlah_transaksi',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
