<?php

namespace App\Http\Controllers\PMB;

use App\Http\Controllers\Controller;
use App\Models\ExamSession;
use App\Models\ExamUserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamSessionController extends Controller
{
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'exam_session_id' => 'required|exists:exam_sessions,id',
        ]);
        $data['user_id'] = Auth::user()->id;
        ExamUserSession::create($data);
        alert()->success('Berhasil', 'berhasil memilih sesi ujian');
        return back();
    }
}
