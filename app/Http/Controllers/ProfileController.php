<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = auth()->user();

        // Ambil riwayat order milik user tersebut
        // Pastikan model User memiliki relasi hasMany ke model Order
        $orders = $user->orders()->with('product')->latest()->get();

        // Hitung total belanja sukses
        $totalSpent = $orders->whereIn('status', ['completed', 'success'])->sum('total_price');

        return view('profile', compact('orders', 'totalSpent'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}