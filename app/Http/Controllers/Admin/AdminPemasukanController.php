<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPemasukanController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['product', 'user'])
            ->orderByDesc('sale_date')
            ->get();

        return view('admin.pemasukan.index', compact('sales'));
    }
}
