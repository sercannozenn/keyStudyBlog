<?php


namespace App\Services;


use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function guard(): string
    {
        if (Auth::guard()->check())
        {
            return 'web';
        }
        else if (Auth::guard('api')->check())
        {
            return 'api';
        }
    }
}
