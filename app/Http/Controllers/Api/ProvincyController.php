<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provincy;
use Illuminate\Http\Request;

class ProvincyController extends Controller
{
    public function index(Request $request)
    {
        $data['provincies'] = Provincy::select('id', 'name')->get();
        return $this->getSuccessResponse($data);
    }
}
