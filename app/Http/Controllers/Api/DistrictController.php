<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        $data['districts'] = District::select('id', 'name', 'city_id')
        ->when($request->city_id, function ($query) use ($request)
        {
            $query->where('city_id', $request->city_id);
        })
        ->when($request->name, function ($query) use ($request)
        {
            $query->where('name', 'ilike', '%'.$request->name.'%');
        })
        ->get();
        return $this->getSuccessResponse($data);
    }
}
