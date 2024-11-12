<?php

namespace App\Http\Controllers\PMB;

use App\Http\Controllers\Controller;

use App\Models\FileUpload;
use App\Models\InformationSource;
use App\Models\PaymentType;
use App\Models\RegistrationPath;
use App\Models\UserFileUpload;
use App\Models\UserInformationSource;
use App\Models\UserPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function index()
    {
        $informations = InformationSource::get();
        $registration_path = @Auth::user()->user_information->registration_path;
        if($registration_path->id == RegistrationPath::JALUR_TEST){
            $file_uploads = FileUpload::whereIn('id', FileUpload::JALUR_TEST)->get();
        }elseif($registration_path->id == RegistrationPath::JALUR_NON_TEST){
            $file_uploads = FileUpload::whereIn('id', FileUpload::JALUR_NON_TEST)->get();
        }elseif($registration_path->id == RegistrationPath::JALUR_AKADEMIK){
            $file_uploads = FileUpload::whereIn('id', FileUpload::JALUR_AKADEMIK)->get();
        }elseif($registration_path->id == RegistrationPath::JALUR_NON_AKADEMIK){
            $file_uploads = FileUpload::whereIn('id', FileUpload::JALUR_NON_AKADEMIK)->get();
        }elseif($registration_path->id == RegistrationPath::JALUR_KIP){
            $file_uploads = FileUpload::whereIn('id', FileUpload::JALUR_KIP)->get();
        }elseif($registration_path->id == RegistrationPath::JALUR_TRANSFER){
            $file_uploads = FileUpload::whereIn('id', FileUpload::JALUR_TRANSFER)->get();
        }
        $payment_types = PaymentType::where('is_active', true)->get();
        return view('penerimaan-mahasiswa-baru.file_upload', compact('informations', 'file_uploads', 'payment_types'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'information_source' => 'required|array'
        ],[
            'information_source.required' => 'Silahkan pilih salah satu informasi tentang Universitas AKI '
        ]
        );
        $data = $request->all();
        $data['user_id'] = @Auth::user()->id;
        DB::beginTransaction();
        UserInformationSource::where('user_id', @Auth::user()->id)->delete();
        foreach($request->information_source as $value){
            $user_information_source = [
                'user_id' => @Auth::user()->id,
                'information_source_id' => $value,
            ];
            UserInformationSource::updateOrCreate($user_information_source, $user_information_source);
        }
        try {
            if ($request->file()) {
                foreach ($request->file() as $key => $value) {
                    $data['file'] = $value->store('file');
                    $data['file_name'] = $value->getClientOriginalName();
                    $data['file_type'] = str_replace(' ', '-',strtolower(FileUpload::find($key)->name));
                    $data['file_upload_id'] = $key;
                    $file_before = UserFileUpload::where('user_id', @Auth::user()->id)->where('file_upload_id', $data['file_upload_id'])->first();
                    $test = UserFileUpload::updateOrCreate([
                        'user_id' => @Auth::user()->id,
                        'file_upload_id' => $key
                    ],$data);
                    if($test->wasChanged()){
                        if(Storage::exists($file_before->file)){
                            Storage::delete($file_before->file);
                        }
                    }
                }
            }
        } catch (\Throwable $th) {

        }

        UserPayment::updateOrCreate([
            'user_id' => @Auth::user()->id,
            'type'    => UserPayment::TYPE_REGISTRATION,
        ],
        [
            'user_id' => @Auth::user()->id,
            'type'    => UserPayment::TYPE_REGISTRATION,
            'is_validate'=> false,
            'payment_type_id' => $data['payment_type_id'],
        ]);
        DB::commit();
        if($request->next){
            return redirect()->route('payment');
        }else{
            alert()->success('Berhasil','Data berhasil disimpan');
            return back();
        }
    }
}
