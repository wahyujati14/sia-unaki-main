<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubDistrict;
use Illuminate\Http\Request;

class SubDistrictController extends Controller
{
    public function index(Request $request)
    {
        $data['sub_districts'] = SubDistrict::select('id', 'name', 'district_id')
        ->when($request->district_id, function ($query) use ($request)
        {
            $query->where('district_id', $request->district_id);
        })
        ->when($request->name, function ($query) use ($request)
        {
            $query->where('name', 'ilike', '%'.$request->name.'%');
        })
        ->get();
        return $this->getSuccessResponse($data);
    }
}
