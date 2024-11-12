<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $data['cities'] = City::select('id', 'name', 'provincy_id')
        ->when($request->province_id, function ($query) use ($request)
        {
            $query->where('provincy_id', $request->province_id);
        })
        ->when($request->name, function ($query) use ($request)
        {
            $query->where('name', 'ilike', '%'.$request->name.'%');
        })
        ->get();
        return $this->getSuccessResponse($data);
    }
}
