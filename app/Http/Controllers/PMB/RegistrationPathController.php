<?php

namespace App\Http\Controllers\PMB;

use App\Http\Controllers\Controller;

use App\Models\Faculties;
use App\Models\RegistrationPath;
use App\Models\StudyProgram;
use App\Models\UserInformation;
use App\Models\UserStudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationPathController extends Controller
{
    public function index()
    {
        $registration_paths = RegistrationPath::get();
        $study_programs = StudyProgram::orderBy('id', 'asc')->get();
        return view('penerimaan-mahasiswa-baru.registration_path', compact('registration_paths', 'study_programs'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'registration_path_id' => 'required',
            'second_study_program' => 'required',
            'first_study_program' => 'required',
        ],[
            'registration_path_id.required' => 'Jalur Pendidikan harus diisi'
        ]);
        Auth::user()->user_information->update([
            'registration_path_id' => $request->registration_path_id
        ]);
        UserStudyProgram::updateOrCreate(['user_id' => Auth::user()->id, 'type' => 'FIRST',],[
                'user_id' => Auth::user()->id,
                'study_program_id' => $request->first_study_program,
                'type' => 'FIRST',
            ]);
        UserStudyProgram::updateOrCreate(['user_id' => Auth::user()->id, 'type' => 'SECOND',],
            [
                'user_id' => Auth::user()->id,
                'study_program_id' => $request->second_study_program,
                'type' => 'SECOND',
            ]);
        if($request->next){
            return redirect()->route('file_upload');
        }else{
            alert()->success('Sukses','Data Jalur Pendaftaran berhasil disimpan');
            return back();
        }
    }
}
