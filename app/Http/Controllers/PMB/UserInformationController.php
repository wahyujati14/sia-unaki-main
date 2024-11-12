<?php

namespace App\Http\Controllers\PMB;

use App\Http\Controllers\Controller;

use App\Models\Provincy;
use App\Models\RegistrationPeriode;
use App\Models\Religion;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInformationController extends Controller
{

    public function index()
    {
        $religions = Religion::get();
        $provincies = Provincy::select('id', 'name')->get();
        $check_periode = RegistrationPeriode::whereDate('start_at', '<=', date('Y-m-d'))->whereDate('end_at', '>=', date('Y-m-d'))->where('is_active', true)->first();
        if(!$check_periode && !Auth::user()->user_information){
            alert()->error('Maaf','Periode Pendaftaran tidak tersedia silahkan coba beberapa saat lagi');
            return view('penerimaan-mahasiswa-baru.periode_not_exists');
        }
        return view('penerimaan-mahasiswa-baru.index', compact('religions', 'provincies', 'check_periode'));
    }

    public function store(Request $request){

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        UserInformation::updateOrCreate(['user_id' => Auth::user()->id],$data);
        $user = User::find(Auth::user()->id);
        $user->update([
            'nik' => $request->nik
        ]);
        if($request->next){
            return redirect()->route('school_origin');
        }else{
            alert()->success('Sukses','Data identitas berhasil disimpan');
            return back();
        }
    }
}
