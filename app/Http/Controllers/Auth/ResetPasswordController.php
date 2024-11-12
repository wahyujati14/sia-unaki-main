<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected function messages()
    {
        return [
            'email.required' => 'Email harus diisi',
            'email.max' => 'Maksimal panjang karakter Email adalah 255',
            'email.unique' => 'Email sudah terdaftar sebelumnya silahkan menggunakan email yg lain',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal terdiri dari 8 karakter',
            'password.confirmed' => 'Password tidak sama',
        ];
    }



    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
