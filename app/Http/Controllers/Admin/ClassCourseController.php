<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\ClassCourse;
use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $class_courses = ClassCourse::with(['lecturer:id,name', 'course:id,name'])
            ->when($request->get('lecture'), function($query) use ($request) {
                $query->where('lecture_id', $request->get('lecture'));
            })
            ->when($request->get('course'), function($query) use ($request) {
                $query->where('course_id', $request->get('course'));
            })
            ->when($request->get('search'), function($query) use ($request) {
                $search = $request->get('search');

                $query->where(function($query) use ($search) {
                    $query->where('name', 'ilike', '%' .$search. '%')
                        ->orWhere('code', 'ilike', '%'. $search .'%');
                });
            })
            ->paginate();

        return view('admin.class_courses.index', compact('class_courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.class_courses.create');
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
            'course_id' => 'required',
            'lecturer_id' => 'required',
            'semester' => 'required',
            'code' => 'required',
            'credit_course' => 'required',
            'credit_course_hourly' => 'required',
            'credit_course_payment' => 'required',
            'note' => 'nullable'
        ]);

        ClassCourse::create($request->all());

        return redirect(route('class_courses.index'))->with('success', 'Data berhasil ditambahkan');
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
        $class_course = ClassCourse::with(['lecturer:id,name', 'course:id,name'])->find($id);

        if ($class_course == null) return back()->with('failed', 'Data tidak ditemukan');

        return view('admin.class_courses.edit', compact('class_course'));        
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
        $class_course = ClassCourse::find($id);

        $class_course->update($request->all());

        return redirect(route('class_courses.index'))->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = ClassCourse::find($id);

        if ($course == null) return back()->with('failed', 'Data tidak ditemukan');

        $course->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
