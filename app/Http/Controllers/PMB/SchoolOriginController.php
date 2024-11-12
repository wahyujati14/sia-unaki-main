<?php

namespace App\Http\Controllers\PMB;

use App\Http\Controllers\Controller;

use App\Models\SchoolOrigin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolOriginController extends Controller
{
    
    public function index()
    {
        return view('penerimaan-mahasiswa-baru.school_origin');
    }

    public function store(Request $request)
    {
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            SchoolOrigin::updateOrCreate(['user_id' => Auth::user()->id], $data);
        if($request->next){
            return redirect()->route('registration_path');
        }else{
            alert()->success('Sukses','Data Asal Sekolah berhasil disimpan');
            return back();
        }
    }
}
