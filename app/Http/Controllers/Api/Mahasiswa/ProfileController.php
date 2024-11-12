<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $request){
        $profile = Cache::remember('profile', 5, function() {
            return  User::with([
                'user_information.religion',
                'user_information.province',
                'user_information.city',
                'user_information.district',
                'user_information.sub_district',
            ])->find(Auth::user()->id);
        });

        return $this->getSuccessResponse(['profile' => $profile]);
    }

    public function update(Request $request){
        $rule = [
                'nik' => 'sometimes|string',
                'name' => 'sometimes|string',
                'current_address' => 'sometimes|string',
                'phone' => 'sometimes|string',
                'whatsapp' => 'sometimes|string',
                'email' => 'sometimes|string'
            ];

        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return $this->errorValidationResponse($validator);
        }

        $data = $request->validate($rule);
        $request->user()->user_information->update($data);
        $request->user()->update($data);

        return $this->postSuccessResponse(['profile' => $data],'Identitas berhasil diupdate');
    }

    public function academicInformation(Request $request){
        $academicInformation = Cache::remember('academic_information', 5, function() {
            return User::with(
                'school_origin',
                'study_program_selected.study_program.faculty'
            )->find(Auth::user()->id);
        });

        return $this->getSuccessResponse(['academic_information' => $academicInformation]);
    }

    public function parentInformation(Request $request){
        $parentInformation = Cache::remember('parent_information', 5, function() {
            return UserInformation::select('parent_name','biological_mother','parent_phone','parent_address')
            ->whereUserId(Auth::user()->id)
            ->first();
        });

        return $this->getSuccessResponse(['parent_information' => $parentInformation]);
    }

}
