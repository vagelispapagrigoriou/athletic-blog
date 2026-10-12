<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->validated();

        $key = $credentials['email'];

        if(RateLimiter::tooManyAttempts($key, 3)){
            throw ValidationException::withMessages([
                'email' => 'Too many login attempts. Please try again in '
                    . RateLimiter::availableIn($key)
                    . ' seconds.',
            ]);
        }
        
        if (Auth::attempt($credentials)) {
            RateLimiter::clear($key);
            
            $request->session()->regenerate();
            
            return redirect()->intended('/');
            }

        RateLimiter::hit($key, 60);

        throw ValidationException::withMessages([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }
}
