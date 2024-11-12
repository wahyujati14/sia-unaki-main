<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CardController extends Controller
{
    public function myStudentCard(Request $request){
        return $this->getSuccessResponse([
            'user' => User::with('study_program_selected.study_program')->find($request->user()->id),
            'valid_date' => Carbon::parse($request->user()->created_at)->addYears(4)->toDateString()
        ]);
    }
}
