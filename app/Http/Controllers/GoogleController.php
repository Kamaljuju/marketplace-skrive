<?php

namespace App\Http\Controllers;

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
            $user = Socialite::driver('google')->user();
            // Nanti kita buat logika login di sini
            return "Halo " . $user->getName(); 
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}