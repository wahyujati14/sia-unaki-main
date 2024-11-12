<?php

namespace App\Http\Controllers\PMB;

use App\Http\Controllers\Controller;

use App\Models\FileUpload;
use App\Models\InformationService;
use App\Models\PaymentType;
use App\Models\User;
use App\Models\UserFileUpload;
use App\Models\UserPayment;
use App\Models\UserReregistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Xendit\Xendit;

class ReRegistrationController extends Controller
{
    public function index()
    {
        $payment_types = PaymentType::where('is_active', true)->get();
        return view('penerimaan-mahasiswa-baru.re-registration', compact('payment_types'));
    }

    public function show($id)
    {
        $user_payment = User::find($id)->user_payments->where('type', UserPayment::TYPE_REREGISTRATION)->first();
        Xendit::setApiKey(env('XENDIT_SECRET_KEY'));
        $external_id = UserPayment::getInvoiceNumber(UserPayment::TYPE_REREGISTRATION, Auth::user());
        if($user_payment?->xendit_id){
            $createInvoice = \Xendit\Invoice::retrieve($user_payment?->xendit_id);
        }else{
            $params = [
                'external_id' => $external_id,
                'payer_email' => Auth::user()->email,
                'description' => UserPayment::TYPE_REREGISTRATION,
                'amount' => UserPayment::getAmount(UserPayment::TYPE_REREGISTRATION, User::find($id)),
            ];
            $createInvoice = \Xendit\Invoice::create($params);
        }
        UserPayment::updateOrCreate([
            'user_id' => @Auth::user()->id,
            'type'    => UserPayment::TYPE_REREGISTRATION,
        ],
        [
            'user_id' => @Auth::user()->id,
            'type'    => UserPayment::TYPE_REREGISTRATION,
            'is_validate'=> false,
            'payment_type_id' => PaymentType::XENDIT,
            'external_id' => $external_id,
            'xendit_id' => $createInvoice['id']
        ]);
        return redirect($createInvoice['invoice_url']);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = @Auth::user()->id;
        DB::beginTransaction();
        try {
            $user_payment = UserPayment::updateOrCreate([
                'user_id' => @Auth::user()->id,
                'type'    => UserPayment::TYPE_REREGISTRATION,
            ],
            [
                'user_id' => @Auth::user()->id,
                'type'    => UserPayment::TYPE_REREGISTRATION,
                'payment_type_id' => $request->payment_type_id,
                'nominal' => UserPayment::getAmount(UserPayment::TYPE_REREGISTRATION, Auth::user())
            ]);
            if($user_payment?->payment_type_id == \App\Models\PaymentType::UPLOAD_BUKTI){
                if($request->upload_bukti){
                    $data['file'] = $request->upload_bukti->store('file');
                    $data['file_name'] = $request->upload_bukti->getClientOriginalName();
                    $data['file_type'] = str_replace(' ', '-',strtolower(FileUpload::find(FileUpload::RE_REGISTRATION)->name));
                    $data['file_upload_id'] = FileUpload::RE_REGISTRATION;
                    $file_before = UserFileUpload::where('user_id', @Auth::user()->id)->where('file_upload_id', $data['file_upload_id'])->first();
                    $test = UserFileUpload::updateOrCreate([
                        'user_id' => @Auth::user()->id,
                        'file_upload_id' => FileUpload::RE_REGISTRATION
                    ],$data);
                    if($test->wasChanged()){
                        if(Storage::exists($file_before->file)){
                            Storage::delete($file_before->file);
                        }
                    }
                }
    
                if($request->pas_photo){
                    $photo['file'] = $request->pas_photo->store('file');
                    $photo['file_name'] = $request->pas_photo->getClientOriginalName();
                    $photo['file_type'] = str_replace(' ', '-',strtolower(FileUpload::find(FileUpload::PAS_PHOTO)->name));
                    $photo['file_upload_id'] = FileUpload::PAS_PHOTO;
                    $file_before = UserFileUpload::where('user_id', @Auth::user()->id)->where('file_upload_id', $photo['file_upload_id'])->first();
                    $test = UserFileUpload::updateOrCreate([
                        'user_id' => @Auth::user()->id,
                        'file_upload_id' => FileUpload::PAS_PHOTO
                    ],$photo);
                    if($test->wasChanged()){
                        if(Storage::exists($file_before->file)){
                            Storage::delete($file_before->file);
                        }
                    }
                }
            }
            $user_reregister = [
                'user_id' => $data['user_id'],
                'user_payment_id' => $user_payment->id
            ];
            UserReregistration::updateOrCreate($user_reregister, $user_reregister);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            alert()->error('Gagal', 'Upload Berkas Gagal, silahkan coba lagi nanti');
            return redirect()->route('dashboard');
        }
        alert()->success('Sukses','Selamat Pendaftaran berhasil dilakukan, silakan mengecek email secara berkala untuk mendapatkan informasi lebih lanjut !!');
        return redirect()->route('dashboard');
    }
}
