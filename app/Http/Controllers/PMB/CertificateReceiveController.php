<?php

namespace App\Http\Controllers\PMB;

use App\Http\Controllers\Controller;

use App\Models\CertificateReceive;
use App\Models\ExamUserSession;
use App\Models\InformationService;
use App\Models\UserExam;
use App\Models\UserHealthContribution;
use App\Models\UserInitialPayment;
use App\Models\UserKemahasiswaanContribution;
use App\Models\UserLibraryContribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penerimaan-mahasiswa-baru.certificate-receive');
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
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $certificate_receive = CertificateReceive::create($data);
        $data['certificate_receive_id'] = $certificate_receive->id;
        $data['nominal'] = InformationService::find(1)->initial_payment;
        UserInitialPayment::create($data);
        $data['nominal'] = InformationService::find(1)->kemahasiswaan_contribution;
        UserKemahasiswaanContribution::create($data);
        $data['nominal'] = InformationService::find(1)->library_contribution;
        UserLibraryContribution::create($data);
        $data['nominal'] = InformationService::find(1)->health_payment;
        UserHealthContribution::create($data);
        return redirect()->back()->with('success', 'Pengajuan berhasil di lakukan');

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
        //
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

    public function reexam()
    {
        $exam_count = \App\Models\ExamUserSession::where('user_id', Auth::user()->id)->withTrashed()->get();
        if ($exam_count->count() < 2){
            if (date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($exam_count->first()->deleted_at)).'00:00:00'. '+ 1 days')) > date('Y-m-d H:i:s')){
                alert()->failed('Gagal', 'Ujian Gagal di buat, waktu terlewati');
                return back();
            }else{
                ExamUserSession::where('user_id', @Auth::user()->id)->delete();
                alert()->success('Berhasil', 'Silahkan ikuti ujian lagi');
                return back();
            }
        }
        else{
            alert()->failed('Gagal', 'Ujian Gagal di buat, Kesempatan habis');
            return back();
        }
    }
}
