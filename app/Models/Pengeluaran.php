<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $fillable = ['tanggal', 'deskripsi', 'jumlah'];
    protected $casts = [
        'tanggal' => 'date',
    ];
}
