<?php

namespace App\Http\Controllers;

use App\Traits\ResponseWithHttpStatus;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getSuccessResponse($data = [])
    {
        $data = [
            'code' => 200,
            'message' => 'Successfully Get Data',
            'data' => $data,
        ];
        return response()->json($data, 200);
    }

    public function postSuccessResponse($data = [],$message = null)
    {
        $data = [
            'code' => 200,
            'message' => $message ?? 'Successfully Post Data',
            'data' => $data,
        ];
        return response()->json($data, 200);
    }

    public function acceptedSuccessResponse($data = [])
    {
        $data = [
            'code' => 202,
            'message' => 'Successfully Tamporary Post Data',
            'data' => $data,
        ];
        return response()->json($data, 202);
    }

    public function notAutSuccessResponse($data = [])
    {
        $data = [
            'code' => 203,
            'message' => 'Successfully Post Data',
            'data' => $data,
        ];
        return response()->json($data, 203);
    }

    public function failedResponse($data = [], $message = 'Failed Process Data', $code = 422)
    {
        $data = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($data, $code);
    }

    public function notFoundResponse($data = [])
    {
        $data = [
            'code' => 404,
            'message' => 'Page Not Found',
            'data' => $data,
        ];
        return response()->json($data, 404);
    }

    protected function errorValidationResponse($validator){
        return response()->json([
          'code'  => 422,
          'success'=> false,
          'data' => null,
          'error' =>$validator->errors()->first()
        ],422);
    }

}
