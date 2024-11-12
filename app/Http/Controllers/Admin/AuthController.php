<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/admin';

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required'
        ]);
        if(Auth::guard('admin')->attempt($request->only('username', 'password'), $request->remember)){
            return redirect(route('dashboard_admin'))->with('success', 'Berhasil Login');
        }else{
            $errors = new MessageBag(['password' => ['Username and/or password invalid.']]);
            return redirect(route('admin'))->withErrors($errors);
        };
        // dd(Auth::guard('admin')->user());
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/admin');
    }
}
