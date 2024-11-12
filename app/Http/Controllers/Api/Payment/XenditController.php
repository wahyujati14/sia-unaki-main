<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Models\InformationService;
use App\Models\UserPayment;
use App\Helpers\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Xendit\Xendit;

class XenditController extends Controller
{
    public function callback(Request $request)
    {
        $user_payment = UserPayment::where('xendit_id', $request->id)->first();
        if($user_payment){
            if($request->status == 'PAID'){
                $user_payment->update([
                    'is_validate' => true,
                    'status' => $request->status
                ]);
                return $this->postSuccessResponse();
            }else{
                if($user_payment->status != 'PAID'){
                    $user_payment->update([
                        'status' => $request->status
                    ]);
                }
                return $this->postSuccessResponse();
            }
        }else{
            return $this->notFoundResponse();
        }
    }
}
