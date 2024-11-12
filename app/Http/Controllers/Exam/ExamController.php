<?php

namespace App\Http\Controllers\PMB;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Score;
use App\Models\UserAnswer;
use App\Models\UserExam;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function start(){

        if($this->can_start()){
            $user_exam = UserExam::Create([
                'exam_id' => $this->exam()->id,
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['success'=>true],200);
        }else{
            return response()->json(['success'=>false],200);
        }
    }
    public function index(Request $request){

        if(empty($this->user_exam())){
            return redirect('pmb/home');
        }
        $data = ['is_first'=>true,'is_last'=>false];
        $data['exam'] = $this->exam();
        $data['question'] = Question::where('exam_id',$this->exam()->id)->orderby('order')->first();
        $questions = Question::where('exam_id',$this->exam()->id)->orderby('order');
        $data['questions'] = $questions->get();
        $data['question_answered'] =  $questions->WhereHas('user_answer', fn($query) =>
            $query->where('user_exam_id', $this->user_exam()->id )
        )->count();
        $data['answers'] = Answer::where('question_id',$data['question']->id)->get();
        $answer_selected = UserAnswer::where('user_exam_id',$this->user_exam()->id)
        ->where('question_id',$data['question']->id)
        ->first();
        $data['answer_selected'] = $answer_selected ? $answer_selected->answer_id : 0;

        return view('PMB.exam.index')->with($data);
    }

    public function show_question($id){
        $data['question'] = Question::find($id);
        $data['answers'] = Answer::where('question_id',$id)->get();
        $first_answer = Question::where('exam_id',$data['question']->exam_id)->orderBy('order','asc')->first();
        $last_answer = Question::where('exam_id',$data['question']->exam_id)->latest('order')->first();
        $data['is_first'] = $first_answer->id == $id ? true : false;
        $data['is_last'] = $last_answer->id == $id ? true : false;
        $answer_selected = UserAnswer::where('user_exam_id',$this->user_exam()->id)
        ->where('question_id',$data['question']->id)
        ->first();
        $data['answer_selected'] = $answer_selected ? $answer_selected->answer_id : 0;

        return view('PMB.exam.component.question')->with($data)->render();
    }

    public function next_question($id){
        $next_question_id = Question::where('id', '>', $id)->min('id');
        return $this->show_question($next_question_id);
    }
    public function previous_question($id){
        $next_question_id = Question::where('id', '<', $id)->max('id');
        return  $this->show_question($next_question_id);
    }

    public function choose_answer(Request $request,$id){
        $user_answer = UserAnswer::updateOrCreate([
            'user_id' => Auth::user()->id,
            'user_exam_id' => $this->user_exam()->id,
            'question_id' => $request->question_id,
        ],
        [
            'user_id' => Auth::user()->id,
            'user_exam_id' => $this->user_exam()->id,
            'question_id' => $request->question_id,
            'answer_id' => $id
        ]);
        return $user_answer;
    }

    public function exam(){
        return Exam::where('is_active',1)->latest()->first();
    }
    public function user_exam(){
        return UserExam::where('user_id',Auth::user()->id)
        ->where('exam_id',$this->exam()->id)
        ->whereNull('actual_score')
        ->latest()
        ->first();
    }

    public function show_question_map($id){
        $data['question'] = Question::find($id);
        $questions = Question::where('exam_id',$this->exam()->id)->orderby('order');
        $data['questions'] = $questions->get();
        $data['question_answered'] =  $questions->WhereHas('user_answer', fn($query) =>
            $query->where('user_exam_id', $this->user_exam()->id )
        )->count();
        return view('PMB.exam.component.question-map')->with($data)->render();
    }

    public function finish(){
       return  $this->user_exam()->update([
            'actual_score' => $this->count_score()['actual_score'],
            'score_id' => $this->count_score()['score_id'],
            'is_success' => $this->count_score()['is_success'],
        ]);
    }

    function count_score(){
        //cek jumlah soal yg benar
        $user_answer = UserAnswer::where('user_id',Auth::user()->id)
        ->where('user_exam_id',$this->user_exam()->id)
        ->has('question')
        ->count();

        //hitung prosentase benar
        $question = Question::where('exam_id',$this->exam()->id)->count();
        $data['actual_score'] = floor(($user_answer * 100) / $question);

        //hitung kategori score
        $score = Score::where('start_score','<=',$data['actual_score'])
        ->orderBy('start_score','DESC')
        ->first();
        $data['score_id'] = $score ? $score->id : null;

        //jika tidak masuk kategori tidak lolos
        $data['is_success'] = $score ? true : false;
        return $data;
    }

    public function can_start(){
        $user_exam = UserExam::where('user_id',Auth::user()->id)
        ->where('exam_id',$this->exam()->id);

        if($user_exam->count() > 0  ){
            $max_repeat_time = Carbon::parse($user_exam->first()->updated_at)->addHours(24);
            if(Carbon::now() <= $max_repeat_time && $user_exam->count() < 2){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

}
