<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AuthController extends Controller
{
    //
    public function register()
    {
        return Inertia::render('User/Register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:4', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            return back(303)
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            auth()->login($user);
            $request->session()->regenerate();
            return redirect()->route('home');
        }
    }

    public function login()
    {
        return Inertia::render('User/Login');
    }

    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            return back(303)
                ->withErrors($validator)
                ->withInput();
        } else {
            if (

                auth()->attempt([
                    "email" => $request->email,
                    "password" => $request->password,
                ], true)
            ) {
                $request->session()->regenerate();
                return redirect()->route('home');
            } else {
                return redirect()->route('login')->with([
                    'message' => 'These credentials do not match any of our records !'
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function profile(Request $request)
    {
        return inertia::render('User/Profile');
    }

    public function updateProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo_url' => ['required', 'mimes:jpeg,png,gif,bmp,tiff,jpg,webp,svg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return back(303)
                ->withErrors($validator)
                ->withInput();
        }
        else {
            if (Storage::disk('public')->exists(auth()->user()->photo_url)) {
                Storage::disk('public')->delete(auth()->user()->photo_url);
            }
    
            $file = $request->file('photo_url');
            $path = $file->store('profiles', 'public');
    
            auth()->user()->update([
                'photo_url' => $path,
            ]);
    
            return redirect()->route('profile')->with([
                "message" => "Profile updated successfully with new photo url",
            ]);
        }

    }
}