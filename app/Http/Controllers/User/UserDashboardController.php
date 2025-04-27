<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $gajiKaryawan = DB::table('users')->sum('gaji');
        return view('dashboard', compact('gajiKaryawan'));

    }
}
