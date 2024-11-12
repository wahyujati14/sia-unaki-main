<?php

namespace App\Http\Controllers\PMB;

use App\Http\Controllers\Controller;

use App\Models\FileUpload;
use App\Models\InformationService;
use App\Models\User;
use App\Models\UserFileUpload;
use App\Models\UserPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Terbilang;
use Xendit\Xendit;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_payment = Auth::user()->user_payments->where('type', UserPayment::TYPE_REGISTRATION)->first();
        $payment_registration = InformationService::find(1)->payment_registrations;
        $payment_registrations = Terbilang::make($payment_registration);
        return view('penerimaan-mahasiswa-baru.payment', compact('user_payment', 'payment_registrations', 'payment_registration'));
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
        $data['user_id'] = @Auth::user()->id;
        $user_payment = Auth::user()->user_payments->where('type', UserPayment::TYPE_REGISTRATION)->first();
        if($user_payment?->payment_type_id == \App\Models\PaymentType::UPLOAD_BUKTI){
            $data['file'] = $request->upload_file_scan->store('file');
            $data['file_name'] = $request->upload_file_scan->getClientOriginalName();
            $data['file_type'] = str_replace(' ', '-',strtolower(FileUpload::find(FileUpload::SCAN_BUKTI_PEMBAYARAN)->name));
            $data['file_upload_id'] = FileUpload::SCAN_BUKTI_PEMBAYARAN;
            $file_before = UserFileUpload::where('user_id', @Auth::user()->id)->where('file_upload_id', $data['file_upload_id'])->first();
            $test = UserFileUpload::updateOrCreate([
                'user_id' => @Auth::user()->id,
                'file_upload_id' => FileUpload::SCAN_BUKTI_PEMBAYARAN
            ],$data);
            if($test->wasChanged()){
                if(Storage::exists($file_before->file)){
                    Storage::delete($file_before->file);
                }
            }
        }
        alert()->success('Sukses','Selamat Pendaftaran berhasil dilakukan, silakan mengecek email secara berkala untuk mendapatkan informasi lebih lanjut !!');
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_payment = User::find($id)->user_payments->where('type', UserPayment::TYPE_REGISTRATION)->first();
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
        if($user_payment?->xendit_id){
            $createInvoice = \Xendit\Invoice::retrieve($user_payment?->xendit_id);
        }else{
            $params = [
                'external_id' => UserPayment::getInvoiceNumber(UserPayment::TYPE_REGISTRATION, Auth::user()),
                'payer_email' => Auth::user()->email,
                'description' => UserPayment::TYPE_REGISTRATION,
                'amount' => UserPayment::getAmount(UserPayment::TYPE_REGISTRATION),
            ];
            $createInvoice = \Xendit\Invoice::create($params);
        }
        $user_payment->update([
            'external_id' => $createInvoice['external_id'],
            'xendit_id' => $createInvoice['id'],
        ]);
        return redirect($createInvoice['invoice_url']);
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

    public function getInvoice(Request $request)
    {
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
        $params = ['external_id' => 'demo_147580196270',
            'payer_email' => Auth::user()->email,
            'description' => 'Pembayaran Registration',
            'amount' => InformationService::find(1)->payment_registrations,
        ];
        $createInvoice = \Xendit\Invoice::create($params);
        return $createInvoice;
    }
}
