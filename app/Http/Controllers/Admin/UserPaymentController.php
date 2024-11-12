<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use App\Models\UserPayment;
use Illuminate\Http\Request;

class UserPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_payments = UserPayment::
        when($request->name, function ($query)
        {
           $query->whereHas('user', function ($query)
           {
                $query->where('name', 'ilike', '%'.request()->name.'%');
           });
        })
        ->when($request->status, function ($query)
        {
            $query->where('status', 'ilike', '%'.request()->status.'%');
        })
        ->when($request->type, function ($query)
        {
            $query->where('type', 'ilike', '%'.request()->type.'%');
        })
        ->when($request->payment_type_id, function ($query)
        {
            $query->where('payment_type_id', 'ilike', '%'.request()->payment_type_id.'%');
        })
        ->when($request->is_validate, function ($query)
        {
            $query->where('is_validate', 'ilike', '%'.request()->is_validate.'%');
        })
        ->orderBy('id', 'desc')->paginate(10);
        $data = $request->all();
        $data['types'] = UserPayment::getType();
        $data['payment_types'] = PaymentType::select('id', 'name')->get();
        return view('admin.user_payments.index', compact('user_payments', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_payment = UserPayment::find($id);
        $user_payment->update([
            'is_validate' => $request->is_validate,
            'status' => $request->status
        ]);
        return redirect()->back()->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
