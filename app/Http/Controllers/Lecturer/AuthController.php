<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dosen';

    protected function guard()
    {
        return Auth::guard('lecturer');
    }

    public function index()
    {
        return view('lecturer.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string',
            'password' => 'required'
        ]);

        if(Auth::guard('lecturer')->attempt($request->only('code', 'password'), $request->remember)){
            return redirect(route('lecturer.dashboard'))->with('success', 'Berhasil Login');
        }else{
            $errors = new MessageBag(['password' => ['Username and/or password invalid.']]);
            return redirect(route('lecturer.auth'))->withErrors($errors);
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
            : redirect('/dosen');
    }
}
