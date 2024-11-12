<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassCourse;
use App\Models\ScheduleClassCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleClassCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schedules = ScheduleClassCourse::with('class_course')
            ->when($request->get('day'), function($query) use ($request) {
                $query->where('days', $request->get('day'));
            })
            ->when($request->get('room_id'), function($query) use ($request) {
                $query->where('room_id', $request->get('room_id'));
            })
            ->when($request->get('search'), function($query) use ($request) {
                $query->where('code', 'ilike', $request->get('search'));
            })
            ->orderBy('code')
            ->paginate();

        $days = ScheduleClassCourse::days();

        return view('admin.schedule_class_courses.index', compact('schedules', 'days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $days = ScheduleClassCourse::days();
        $courses = ClassCourse::with(['course', 'lecturer'])->get()->sortBy('course.name');

        return view('admin.schedule_class_courses.create', compact('days', 'courses'));
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
            'class_course_id' => 'required',
            'days' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        if ($validator->fails()) return back()->with('failed', $validator->errors()->first());

        ScheduleClassCourse::create($request->all());

        return redirect(route('schedule_class_courses.index'))->with('success', 'Data berhasil ditambahkan');
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
        $schedule = ScheduleClassCourse::find($id);

        if ($schedule == null) return back()->with('failed', 'Data tidak ditemukan');

        $days = ScheduleClassCourse::days();

        return view('admin.schedule_class_courses.edit', compact('schedule', 'days'));
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
        $schedule = ScheduleClassCourse::find($id);

        if ($schedule == null) return back()->with('failed', 'Data tidak ditemukan');

        $validator = Validator::make($request->all(), [
            'class_course_id' => 'required',
            'days' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        $schedule->update($request->all());

        return redirect(route('schedule_class_courses.index'))->with('Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = ScheduleClassCourse::find($id);

        if ($schedule == null) return back()->with('failed', 'Data tidak ditemukan');

        $schedule->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
