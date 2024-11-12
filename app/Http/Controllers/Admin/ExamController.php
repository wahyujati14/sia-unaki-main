<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamLevel;
use App\Models\ExamRegistrationPath;
use App\Models\RegistrationPath;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $exams = Exam::orderBy('id', 'desc')->get();
        $data = $request->all();
        return view('admin.exams.index', compact('exams', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exam_levels = ExamLevel::get();
        $registration_paths = RegistrationPath::whereNotIn('id', ExamRegistrationPath::pluck('registration_path_id')->toArray())->orderBy('id')->get();
        return view('admin.exams.create', compact('exam_levels', 'registration_paths'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string',
            'exam_level_id' => 'required|exists:exam_levels,id',
            'is_active' => 'required',
            'duration' => 'required|string',
            'registration_path_id'=> 'required|array'
        ]);
        $exam = Exam::create($data);
        if(is_array($data['registration_path_id'])){
            foreach ($data['registration_path_id'] as $key => $value) {
                ExamRegistrationPath::create([
                    'exam_id' => $exam->id,
                    'registration_path_id' => $value
                ]);
            }
        }
        return redirect()->route('exams.index')->with('success', 'Data berhasil di tambahkan');
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
        $exam = Exam::find($id);
        $exam_levels = ExamLevel::get();
        $registration_paths = RegistrationPath::has('exam_registration_path')->orWhereNotIn('id', ExamRegistrationPath::pluck('registration_path_id')->toArray())->orderBy('id')->get();
        return view('admin.exams.edit', compact('exam', 'exam_levels', 'registration_paths'));
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
        $data = $this->validate($request, [
            'name' => 'sometimes|string',
            'exam_level_id' => 'sometimes|exists:exam_levels,id',
            'is_active' => 'sometimes',
            'duration' => 'sometimes|string',
            'registration_path_id'=> 'required|array'
        ]);
        
        $exam = Exam::find($id);
        $exam->update($data);
        if(is_array($data['registration_path_id'])){
            ExamRegistrationPath::where('exam_id', $exam->id)->delete();
            foreach ($data['registration_path_id'] as $key => $value) {
                ExamRegistrationPath::create([
                    'exam_id' => $exam->id,
                    'registration_path_id' => $value
                ]);
            }
        }
        return redirect()->route('exams.index')->with('success', 'Data berhasil di tambahkan');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::find($id);
        $exam->questions()->delete();
        $exam->exam_registration_paths()->delete();
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Data berhasil di hapus');
    }
}
