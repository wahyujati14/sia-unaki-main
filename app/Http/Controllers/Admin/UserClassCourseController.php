<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassCourse;
use App\Models\StudyPlanCard;
use App\Models\UserClassCourse;
use Illuminate\Http\Request;

class UserClassCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = UserClassCourse::with(['class_course', 'study_plan_card.user', 'study_plan_card.academic_year', 'course', 'lecturer'])
            ->ofForeignId('course_id', $request->get('course_id'))
            ->ofForeignId('lecturer_id', $request->get('lecturer_id'))
            ->paginate();

        return view('admin.user_class_courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user_class_courses.create');
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
            'class_course_id' => 'required',
            'study_plan_card_id' => 'required',
        ]);

        $class_course = ClassCourse::find($request->get('class_course_id'));

        $request->merge([
            'credit_course' => $class_course->credit_course,
            'lecturer_id' => $class_course->lecturer_id,
            'course_id' => $class_course->course_id
        ]);

        UserClassCourse::create($request->all());

        return redirect(route('user_class_courses.index'))->with('success', 'Data berhasil ditambahkan');
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
        $user_class_course = UserClassCourse::find($id);

        return view('admin.user_class_courses.edit', compact('user_class_course'));
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
            'class_course_id' => 'required',
            'study_plan_card_id' => 'required',
        ]);

        $class_course = ClassCourse::find($request->get('class_course_id'));

        $request->merge([
            'credit_course' => $class_course->credit_course,
            'lecturer_id' => $class_course->lecturer_id,
            'course_id' => $class_course->course_id
        ]);

        UserClassCourse::find($id)->update($request->all());

        return redirect(route('user_class_courses.index'))->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserClassCourse::find($id)->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
