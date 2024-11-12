<?php

namespace App\Http\Controllers\Api\Mahasiswa\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){

        $rule = [
            'nim' => 'required|string',
            'password' => 'required|string'
        ];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return $this->errorValidationResponse($validator);
        }

        if(!Auth::attempt($request->only('nim','password'))){
            return $this->failedResponse([],'Nim atau password tidak sesuai', 401);
        }
        $user = User::whereNim($request->nim)->first();

        return $this->postSuccessResponse([
            'user'		=> $user,
            'token' 	=> $user->createToken('sista')->accessToken,
        ],'Selamat anda berhasil login');
    }

    public function logout(Request $request){
        $user = $request->user()->token();
        if ($user) {
            $user->revoke();
            return $this->postSuccessResponse([],'Anda berhasil logout !');
        }else{
            return $this->failedResponse([],'unauthenticated !');
        }
    }

}
