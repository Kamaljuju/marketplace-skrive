<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    public function redirect()
    {
        // Kita tes apakah Socialite terbaca
        return Socialite::driver('google')->redirect();
    }

public function callback()
{
    try {
        $googleUser = Socialite::driver('google')->user();
        
        // Cari atau buat user berdasarkan email
        $user = \App\Models\User::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'password' => bcrypt('password_acak_atau_dari_env'),
        ]);

        // Login user tersebut ke sesi Laravel
        \Illuminate\Support\Facades\Auth::login($user);

        return redirect('/'); // Arahkan ke halaman utama/dashboard
    } catch (\Exception $e) {
        return redirect('/login')->withErrors(['email' => 'Gagal login: ' . $e->getMessage()]);
    }
}
}