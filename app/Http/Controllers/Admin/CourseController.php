<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Course::with('study_program:id,name')
        ->when($request->get('study_program_id'), function($query) use ($request) {
            $query->where('study_program_id', $request->get('study_program_id'));
        })
        ->when($request->get('name'), function($query) use ($request) {
            $search = $request->get('search');

            $query->where(function($query) use ($search) {
                $query->where('name', 'ilike', '%' . $search . '%')
                    ->orWhere('code', 'ilike', '%'. $search .'%');
            });
        })
        ->paginate();

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
            'study_program_id' => 'required'
        ]);

        $validator->validate();

        if ($validator->fails()) {
            return back()->with('failed', $validator->errors()->first());
        }

        Course::updateOrCreate($validator->validated(), $validator->validated());

        return redirect(route('courses.index'))->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::with('study_program:id,name')->find($id);
        $study_programs = StudyProgram::select('id', 'name')->get();

        return view('admin.courses.edit', compact('course', 'study_programs'));
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
        $course = Course::find($id);

        if (!$course) return back()->with('failed', 'Data tidak ditemukan');

        $course->update($request->only(['study_program_id', 'name']));

        return redirect(route('courses.index'))->with('success', 'Berhasil mengedit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if ($course == null) return back()->with('failed', 'Data tidak ditemukan');

        $course->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
