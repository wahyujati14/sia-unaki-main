<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScheduleStudyPlanCard;
use App\Models\StudyPlanCard;
use Illuminate\Http\Request;

class ScheduleStudyPlanCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schedules = ScheduleStudyPlanCard::with(['academic_year', 'study_program'])
            ->ofForeignId('academic_year_id', $request->get('academic_year_id'))
            ->ofForeignId('study_program_id', $request->get('study_program_id'))
            ->paginate();

        return view('admin.schedule_study_plan_cards.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schedule_study_plan_cards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schedule = ScheduleStudyPlanCard::create($request->all());

        return redirect(route('schedule_study_plan_cards.index'))->with('success', 'Data berhasil diupload');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
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
        $schedule = ScheduleStudyPlanCard::findOrFail($id);
        
        return view('admin.schedule_study_plan_cards.edit', compact('schedule'));
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
        $schedule = ScheduleStudyPlanCard::findOrFail($id);

        $schedule->update($request->all());

        return redirect(route('schedule_study_plan_cards.index'))->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = ScheduleStudyPlanCard::findOrFail($id);
        
        $schedule->delete();

        return redirect(route('schedule_study_plan_cards.index'))->with('success', 'Data berhasil diedit');
    }
}
