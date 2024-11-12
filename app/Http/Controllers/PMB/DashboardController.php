<?php

namespace App\Http\Controllers\PMB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $user_informations = Auth::user()->user_information;
        return view('penerimaan-mahasiswa-baru.home', compact('user_informations'));
    }
}
