<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    protected $fillable = ['expenditure_date', 'description', 'amount', 'user_id'];
    protected $casts = ['expenditure_date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

