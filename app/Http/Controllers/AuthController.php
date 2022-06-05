<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\userClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;

class AuthController extends Controller
{

    // Login
    public function index(){
        return view('auth.login',
    [
        'title' => 'Login'
    ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Username / Password Salah!');

    }

    // Register
    public function register(){
        $class = userClass::all();
        return view('auth.register',
        [
            'title' => 'Register',
            'class' => $class,
        ]);
    }

    public function store(Request $request){
       $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'userclass_id' => 'required',
            'password' => 'required|min:8',
            'confirmation' => 'required|same:password',
       ]);

       $validatedData['password'] = Hash::make($validatedData['password']);

       User::create([
           'name' => $validatedData['name'],
           'email' => $validatedData['email'],
           'userclass_id' => $validatedData['userclass_id'],
           'password' => $validatedData['password'], 
       ]);
       return redirect('/')->with('success', 'Registrasi Berhasil!');
       
    }

    //Logout
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
