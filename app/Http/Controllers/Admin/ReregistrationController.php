<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserReregistration;
use Illuminate\Http\Request;

class ReregistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $re_registrations = UserReregistration::orderBy('id', 'desc')->paginate(10);
        return view('admin.re-registrations.index', compact('re_registrations'));
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
        $re_registration = UserReregistration::find($id);
        $student = $re_registration->user;
        return view('admin.re-registrations.show', compact('re_registration', 'student'));
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
        $re_registration = UserReregistration::find($id);
        $re_registration->update([
            'is_approve' => $request->is_approve,
            'status' => ($request->is_approve)?'VALID':'FAILED',
        ]);
        $re_registration->user_payment->update([
            'is_validate' => $request->is_approve,
            'status' => $request->status
        ]);
        $re_registration->user->update([
            'nim' => User::getNim($re_registration->user->user_information->registration_periode->year, $re_registration->user)
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
