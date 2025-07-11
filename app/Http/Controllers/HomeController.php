<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    public function indexAdmin()
    {
        return view('admin.dashboard');
    }

    public function indexUser()
    {
        return view('user.dashboard');
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $g_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $g_user->getId())->first();
            if (empty($user)) {
                $newUser = User::create([
                    'id_level' => 2,
                    'name' => $g_user->getName(),
                    'email' => $g_user->getEmail(),
                    'google_id' => $g_user->getId()
                ]);

                Auth::login($newUser);
                return redirect()->intended('dashboard');
            } else {
                Auth::login($user);
                return redirect()->intended('dashboard');
            }
        } catch (\Throwable $th) {
            dd('Ada yang Error nich' . $th->getMessage());
        }
    }
}
