<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserFileUpload;
use App\Models\UserLecturer;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::when($request->name, function ($query) use ($request) {
            $query->where('name', 'ilike', '%' . $request->name . '%');
        })
            ->when($request->email, function ($query) use ($request) {
                $query->where('email', 'ilike', '%' . $request->email . '%');
            })
            ->when($request->nim, function ($query) use ($request) {
                $query->where('nim', 'ilike', '%' . $request->nim . '%');
            })
            ->when($request->phone, function ($query) use ($request) {
                $query->where('phone', 'ilike', '%' . $request->phone . '%');
            })
            ->when($request->study_program_id, function ($query) use ($request) {
                $query->whereHas('user_study_program', function ($query) use ($request) {
                    $query->where('study_program_id', $request->study_program_id);
                });
            })
            ->when($request->created_at, function ($query) use ($request) {
                $query->whereDate('created_at', date('Y-m-d', strtotime($request->created_at)));
            })
            ->paginate(10);

        $data = $request->all();

        return view('admin.students.index', compact('users', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = User::find($id);

        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Delete berhasil');
    }

    public function assigningLecturer(Request $request, $id)
    {
        $statuses = UserLecturer::statuses();
        $student = User::find($id);
        return view('admin.students.assign-lecturer', compact('student', 'statuses'));
    }

    public function assignLecturer(Request $request, $id)
    {
        UserLecturer::updateOrCreate([
            'user_id' => $id,
            'lecturer_id' => $request->get('lecturer_id'),
        ], $request->only(['lecturer_id', 'status']));

        return redirect(route('students.index'));
    }
}
