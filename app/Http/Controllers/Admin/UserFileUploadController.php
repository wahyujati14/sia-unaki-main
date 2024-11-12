<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileUpload;
use App\Models\UserFileUpload;
use App\Models\UserPayment;
use Illuminate\Http\Request;

class UserFileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $user_file_upload = UserFileUpload::find($id);
        $user_file_upload->update($data);
        if(FileUpload::SCAN_BUKTI_PEMBAYARAN == $user_file_upload->file_upload_id){
            $payment = UserPayment::where('user_id', $user_file_upload->user_id)->where('type', UserPayment::TYPE_REGISTRATION)->first();
        }else{
            $payment = UserPayment::where('user_id', $user_file_upload->user_id)->where('type', UserPayment::TYPE_REREGISTRATION)->first();
        }
        $payment->update(['status' => UserPayment::STATUS_PAID, 'is_validate' => true]);
        return redirect()->back()->with('success', 'Data berhasil di verifikasi');
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
