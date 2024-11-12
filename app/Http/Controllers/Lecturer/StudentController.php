<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request) {
        $users = User::whereHas('lecturer', function($query) {
            $query->where('lecturer_id', Auth::guard('lecturer')->id());
        })->paginate();

        return view('lecturer.students.index', compact('users'));
    }

    public function submitAssignLecturer(Request $request, $user_id, $lecturer_id)   {
         UserLecturer::updateOrCreate([
            'user_id' => $user_id,
            'lecturer_id' => $lecturer_id
        ], [
            'status' => $request->get('status')
        ]);

        return back()->with('success', 'Berhasil mengupdate data');
    }
}
