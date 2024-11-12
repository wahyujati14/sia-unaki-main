<?php

namespace App\Http\Middleware;

use App\Models\UserInformation;
use Closure;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhereIamMiddleware
{
    use AuthenticatesUsers;

    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()){
            if(Auth::user()->email_verified_at){
                if(Auth::user()->user_information){
                    if(Auth::user()->school_origin){
                        if(Auth::user()->user_information->registration_path){
                            if(count(Auth::user()?->user_file_upload??[]) > 0){
                                return $next($request);
                            }else{
                                return redirect()->route('file_upload');
                            }
                        }else{
                            return redirect(route('registration_path'));
                        }
                    }else{
                        return redirect(route('school_origin'));
                    }
                }else{
                    return redirect(route('registered'));
                }
            }else{
                return $this->sendLoginResponse($request);
            }
        }else{
            return redirect(route('showLoginForm'));
        }
        
    }
}
