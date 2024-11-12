<?php

use App\Models\Exam;
use App\Models\RegistrationPeriode;
use App\Models\User;
use App\Models\UserExam;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInformation;
use App\Models\UserAnswer;

//get active registration periode
function registration_periode_active(){
   return RegistrationPeriode::where('year',date('Y'))
    ->where('start_at','<=',Carbon::now())
    ->where('end_at','>=',Carbon::now())
    ->where('is_active',1)
    ->first(); 
}

//cek sudah mengupload bukti bayar pendaftaran
function is_file_upload(){
    $file_upload = User::find(Auth::user()->id)->user_file_upload();
    return $file_upload->count() > 1 ? true : false;
}

//cek jalur pendaftaran
function registration_path(){
    return UserInformation::where('user_id',Auth::user()->id)
    ->with('registration_path')
    ->first()
    ->registration_path->slug;
}

//get schedule ujian online
function exam_schedule(){
    $schedule = Exam::where('is_active',1)->first();
    return Carbon::parse($schedule->schedule)->translatedFormat('d F Y');
}

//convert to A,B,C,D
function to_alphabetic($key){
    if($key == 0){
        $label = "A";
    }elseif($key == 1){
        $label = "B";
    }elseif($key == 2){
        $label = "C";
    }elseif($key == 3){
        $label = "D";
    }elseif($key == 4){
        $label = "E";
    }elseif($key == 5){
        $label = "F";
    }
    return $label;
}

//get status question button
function button_question($question,$value){
    $user_exam = UserExam::where('user_id',Auth::user()->id)->latest()->first();
    $user_answer = UserAnswer::where('question_id',$value->id)->where('user_exam_id',$user_exam->id)->count();

    if($user_answer > 0 && $value->id != $question->id){
        return 'btn-question-success';
    }elseif($value->id == $question->id){
        return 'btn-question-primary';
    }else{
        return 'btn-question-danger';
    }

}

//status repeat exam
function is_repeat_exam(){
    $exam = UserExam::where('user_id',Auth::user()->id)->whereNotNull('actual_score')->count();
    if($exam > 0 && $exam < 2){
        return true;
    }else{
        return false;
    }
}

//status not complate exam exist
function is_on_going_exam(){
    $exam = UserExam::where('user_id',Auth::user()->id)->whereNull('actual_score')->first();
    if(!empty($exam)){
        return true;
    }else{
        return false;
    }
}

// check allow access exam menu
function allow_access_exam(){
    $user_exam = UserExam::where('user_id',Auth::user()->id)->whereNotNull('actual_score')->count();
    if(is_register_payment_validated()){
        if($user_exam > 1){
            if($user_exam < 2){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }else{
        return false;
    }

}
