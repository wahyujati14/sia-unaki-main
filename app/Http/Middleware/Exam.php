<?php

namespace App\Http\Middleware;

use App\Models\UserExam;
use App\Models\Exam as ExamModel;
use App\Models\FileUpload;
use App\Models\UserPayment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Exam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if(Auth::user()->user_file_upload->where('file_upload_id', FileUpload::SCAN_BUKTI_PEMBAYARAN)->first()->file_verification){
        //     return redirect()->route('dashboard')->with('failed', 'Maaf pembayaran anda belum di verifikasi');
        // }
        return $next($request);
    }
}
