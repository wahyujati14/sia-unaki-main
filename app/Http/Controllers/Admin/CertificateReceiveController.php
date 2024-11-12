<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CertificateReceive as MailCertificateReceive;
use App\Models\CertificateReceive;
use App\Models\RegistrationPeriode;
use App\Models\StudyProgram;
use App\Models\User;
use App\Models\UserDiscountPayment;
use App\Models\UserInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Barryvdh\DomPDF\Facade\Pdf;

class CertificateReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $certificate_receives = CertificateReceive::when($request->submission, function ($query)
            {
              $query->where('submission', request()->submission);
            })
            ->orderBy('id', 'desc')->paginate(10);
            $data = $request->all();
            $data['registration_periodes'] = RegistrationPeriode::select('id', 'name')->get();
            $data['study_program'] = StudyProgram::select('id', 'name')->get();
        return view('admin.certificate_receives.index', compact('data', 'certificate_receives'));
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
      $certificate_receive = CertificateReceive::findOrFail($id);
      $user = User::findOrFail($certificate_receive->user_id);
      $data = ['name' => $user->name, 'user' => $user];
      // $pdf = Pdf::loadView('penerimaan-mahasiswa-baru.email-certificate-receive', $data);
      // if(request()->type == 'download'){
      //   return $pdf->download('skd-'.$certificate_receive->nomor_certificate.'.pdf');
      // }
      return view('penerimaan-mahasiswa-baru.email-certificate-receive', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificate_receive = CertificateReceive::find($id);
        return view('admin.certificate_receives.edit', compact('certificate_receive'));
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
        $certificate_receive = CertificateReceive::find($id);
        $data['nomor_certificate'] = CertificateReceive::getNomorCertificate();
        if(!$certificate_receive->study_program_id){
          return redirect()->route('certificate_receives.index')->with('failed', 'Silahkan pilih program study dahulu');
        }
        $certificate_receive->update($data);
        try {
          Mail::to($certificate_receive->user->email)->send(new MailCertificateReceive($certificate_receive->user_id, $certificate_receive->user));
        } catch (\Throwable $th) {

        }
        // if(@$data['discount']){
        //   $data['nominal'] = $data['discount'];
        //   $data['user_id'] = $certificate_receive->user_id;
        //   $data['certificate_receive_id'] = $certificate_receive->id;
        //   UserDiscountPayment::create($data);
        // }
        return redirect()->route('certificate_receives.index')->with('success', 'Data berhasil di update');

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
