<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\User;
use App\Models\UserLecturer;
use Illuminate\Http\Request;

class ApproveStudentController extends Controller
{
    public function index(Request $request)
    {
        $approve_students = User::has('certificate_receive')->has('user_reregistration')->orderBy('id', 'desc')
        ->when($request->name, function ($query) use ($request)
        {
            $query->where('name', 'ilike', '%'.$request->name.'%');
        })
        ->when($request->email, function ($query) use ($request)
        {
            $query->where('email', 'ilike', '%'.$request->email.'%');
        })
        ->when($request->phone, function ($query) use ($request)
        {
            $query->where('phone', 'ilike', '%'.$request->phone.'%');
        })
        ->when($request->created_at, function ($query) use ($request)
        {
            $query->whereDate('created_at', date('Y-m-d', strtotime($request->created_at)));
        })->paginate(10);
        $data = $request->all();
        return view('admin.students.approve_student', compact('approve_students', 'data'));
    }

    public function assignUserLecturer(Request $request)
    {
        $data = $request->all();
        UserLecturer::updateOrCreate(['user_id' => @$data['user_id']], $data);
        return redirect()->back()->with('success', 'Data berhasil di tambahkan');
    }

    public function getLectureByStudyProgram(Request $request)
    {
        $lecturer = Lecturer::select('id', 'name')->when($request->id != 'all', function ($query) use ($request)
        {
            $query->where('study_program_id', $request->id);
        })->get();
        return response()->json($lecturer->pluck('name', 'id'));
    }
}
