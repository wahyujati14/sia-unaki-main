<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lecturers = Lecturer::with(['study_program'])
            ->when($request->get('study_program_id'), function ($query) use ($request) {
                $query->where('study_program_id', $request->get('study_program_id'));
            })
            ->when($request->get('search'), function ($query) use ($request) {
                $search = $request->get('search');
                $query->where(function ($query) use ($search) {
                    $query->where('code', 'ilike', '%' . $search . '%')
                        ->orWhere('number', 'ilike',  '%' . $search . '%')
                        ->orWhere('name', 'ilike', '%' . $search . '%');
                });
            })
            ->orderBy('name', 'asc')
            ->paginate();

        return view('admin.lecturers.index', compact('lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $study_programs = StudyProgram::select('id', 'name')->get();

        return view('admin.lecturers.create', compact('study_programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'study_program_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'number' => 'required',
        ]);

        Lecturer::create(array_merge($request->all(), [
            'password' => Hash::make($request->get('code'))
        ]));

        return redirect(route('lecturers.index'))->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lecturer = Lecturer::with('study_program:id,name')->find($id);

        return view('admin.lecturers.edit', compact('lecturer'));
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
        $this->validate($request, [
            'study_program_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'number' => 'required',
        ]);

        $lecturer = Lecturer::find($id);

        if ($lecturer == null) {
            return back()->with('failed', 'Data tidak ditemukan');
        }

        $lecturer->update(array_merge($request->all(), [
            'password' => $request->get('password')
                ? Hash::make($request->get('password'))
                : Hash::make($request->get('code'))
        ]));

        return redirect(route('lecturers.index'))->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lecturer = Lecturer::find($id);

        if ($lecturer == null) return back()->with('failed', 'Data tidak bisa ditemukan');

        $lecturer->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
