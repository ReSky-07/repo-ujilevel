<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $gajiKaryawan = $user->gaji;;
        return view('dashboard', compact('gajiKaryawan'));
    }
}
