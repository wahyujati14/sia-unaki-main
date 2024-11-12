<?php

namespace App\Http\Middleware;

use App\Models\RegistrationPeriode;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class IsValidRegistrationPeriode
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
        $periode = RegistrationPeriode::where('year',date('Y'))
        ->where('start_at','<=',Carbon::now())
        ->where('end_at','>=',Carbon::now())
        ->where('is_active',1)
        ->first();
        //cek ada periode pendaftaran yg active
        if(empty($periode) && $_POST){
            alert()->warning('Pendaftaran Gagal','Maaf tidak ada Gelombang Pendaftaran yang dibuka, mohon melakukan pendaftaran sesuai dengan jadwal yg telah di tentukan !!');
            return redirect('pmb');
        }
        return $next($request);
    }
}
