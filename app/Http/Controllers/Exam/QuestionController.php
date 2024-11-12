<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamUserAnswer;
use App\Models\UserAnswer;
use App\Models\UserExam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_exam = \App\Models\ExamUserSession::where('user_id', Auth::user()->id)->first();
        if($user_exam){
            if(date('N', strtotime($user_exam->created_at)) >= 4){
                $date_exam = Carbon::parse(date('Y-m-d H:i:s', strtotime($user_exam->created_at.' + 7 days')));
            }else{
                $date_exam = $user_exam->created_at;
            }
            $date_exam->modify('Next Saturday');
        }
        $exam = Auth::user()->user_information?->registration_path?->exam_registration_path?->exam;
        $start_time = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($date_exam)).$user_exam->exam_session->start_time));
        $end_time = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($date_exam)).$user_exam->exam_session->end_time));
        if(count(Auth::user()->exam_user_session->exam_user_answers??[]) == $exam->questions->count()){
            return redirect()->route('dashboard')->with('success', 'Ujian telah selesai di kerjakan');
        }
        
        return view('exams.index', compact('exam', 'end_time', 'start_time'));
        
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
        $data = $request->all();
        $exam_user_answer['exam_question_id'] = $data['question_id'];
        $exam_user_answer['exam_answer_id'] = $data['answer_id'];
        $exam_user_answer['exam_user_session_id'] = Auth::user()->exam_user_session->id;
        ExamUserAnswer::create($exam_user_answer);
        return redirect()->route('exam-questions.index');
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
        $user_answer = UserAnswer::orderBy('created_at', 'desc')->first();
        $question_id = $user_answer->question_id;
        $user_answer->delete();
        return redirect()->route('exam-questions.index', ['question_id' => $question_id]);
    }
}
