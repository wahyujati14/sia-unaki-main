<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamQuestion;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ExamQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam_questions = ExamQuestion::orderBy('id')->paginate(10);
        return view('admin.exam_questions.index', compact('exam_questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exams = Exam::orderBy('id')->get();
        return view('admin.exam_questions.create', compact('exams'));
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
            'exam_id' => 'required|exists:exams,id',
            'question' => 'required|string',
            'image' => 'sometimes',
            'answer' => 'array',
            'is_correct' => 'integer'
        ]);
        DB::beginTransaction();
        try {
            $data['image'] = $request->image->store('image');
            $question = ExamQuestion::create($data);
            foreach ($data['answer'] as $key => $value) {
                ExamAnswer::create([
                    'answer' => $value,
                    'question_id' => $question->id,
                    'is_correct' => ($key == $data['is_correct'])?true:false
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Data gagal di tambahkan');
        }
        return redirect()->route('exam_questions.index')->with('success', 'Data berhasil di tambahkan');
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
        $exam_question = ExamQuestion::findOrFail($id);
        $exams = Exam::orderBy('id')->get();
        return view('admin.exam_questions.edit', compact('exam_question', 'exams'));
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
            'exam_id' => 'required|exists:exams,id',
            'question' => 'required|string',
            'image' => 'sometimes',
            'answer' => 'array',
            'is_correct' => 'integer',
        ]);
        DB::beginTransaction();
        try {
            $exam_question = ExamQuestion::findOrFail($id);
            if($data['image']){
                if($exam_question->image && Storage::exists($exam_question->image)){
                    Storage::delete($exam_question->image);
                }
                $data['image'] = $request->image->store('image');
            }
            $exam_question->update($data);
            foreach ($data['answer'] as $key => $value) {
                $exam_answer = ExamAnswer::find($key);
                $exam_answer->update([
                    'answer' => $value,
                    'is_correct' => ($key == $data['is_correct'])?true:false
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Data gagal di tambahkan');
        }
        return redirect()->route('exam_questions.index')->with('success', 'Data berhasil di simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = ExamQuestion::find($id);
        if(Storage::exists($question->image)){
            Storage::delete($question->image);
        }
        $question->delete();
        return redirect()->route('exam_questions.index')->with('success', 'Data berhasil di hapus');
    }
}
