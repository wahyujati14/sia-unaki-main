<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\ClassCourse;
use App\Models\UserClassCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserClassCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = UserClassCourse::whereHas('class_course', function($query) {
                $query->where('lecturer_id', Auth::guard('lecturer')->id());
            })
            ->ofForeignId('course_id', $request->get('course_id'))
            ->paginate();

        return view('lecturer.user_class_courses.index', compact('courses'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function approve($id) {
        $class = UserClassCourse::find($id);

        $class->markAsApproved();

        return back()->with('success', 'Data berhasil diterima');
    }

    public function decline($id) {
        $class = UserClassCourse::find($id);

        $class->markAsDeclined();

        return back()->with('success', 'Data berhasil ditolak');
    }
}