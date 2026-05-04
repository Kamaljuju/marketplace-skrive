<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Opsional: Double check keamanan (bisa dipertahankan jika ingin proteksi ekstra)
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }

        // Mengambil semua data user dari database
        $users = User::all();
        
        // Mengarahkan ke halaman view manajemen user
        return view('admin.users.index', compact('users'));
    }
}