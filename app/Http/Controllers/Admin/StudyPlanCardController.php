<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\StudyPlanCard;
use App\Models\Faculties;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class StudyPlanCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cards = StudyPlanCard::with(['academic_year', 'user'])
            ->ofForeignId('academic_year_id', $request->get('academic_year_id'))
            ->ofStatus($request->get('status'))
            ->ofStudyProgram($request->get('study_program_id'))
            ->paginate();

        return view('admin.study_plan_cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.study_plan_cards.create');
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
            'user_id' => 'required',
            'academic_year_id' => 'required',
            'status' => 'required',
            'note' => 'required',
        ]);

        StudyPlanCard::create($request->all());

        return redirect(route('study_plan_cards.index'))->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card = StudyPlanCard::with(['user', 'academic_year', 'user_class_courses.class_course.course', 'user_class_courses.study_result_card'])->find($id);

        return view('admin.study_plan_cards.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = StudyPlanCard::find($id);

        return view('admin.study_plan_cards.edit', compact('card'));
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
        $card = StudyPlanCard::find($id);

        $this->validate($request, [
            'user_id' => 'required',
            'academic_year_id' => 'required',
            'status' => 'required',
            'note' => 'required',
        ]);


        $card->update($request->all());

        return redirect(route('study_plan_cards.index'))->with('success', 'Berhasil mengedit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = StudyPlanCard::find($id);

        if ($card == null) return back()->with('faild', 'Data tidak ditemukan');

        $card->delete();

        return back()->with('success', 'Berhasil menghapus data');
    }
}
