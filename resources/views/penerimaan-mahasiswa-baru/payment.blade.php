@extends('layouts.app',['title'=>'File Upload'])
@push('style')
<style>
    .card-payment {
        width: 70%;
        height: 250px;
        top: 302px;
        padding: 2rem;
        margin-top: 0.8rem;
        background: #f1f7ff;
        border: 4px dashed #d6e2ff;
        border-radius: 18px;
        font-size: 0.8rem;
    }
</style>
@endpush
@section('content')
<div class="ml-3 mr-3">
    <div class="row">
        <div class="col-md-9">
            <div class="container container-fluid mx-5">
                <div class="-body">
                    <div class="row">
                        <div class="col-4">
                            <h4 class="fw-600">PENDAFTARAN CALON MAHASISWA BARU {{date('Y')}}</h4>
                            <p>
                                Klik tombol bayar di bagian bawah untuk melanjutkan ke proses pembayaran.
                            </p>
                          </div>
                        <div class="col-3">
                            <p class="mb-1 text-sm text-lato fw-400">Step 5 of 5 - File Upload</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            @if($user_payment?->payment_type_id == \App\Models\PaymentType::UPLOAD_BUKTI)
                            @include('penerimaan-mahasiswa-baru.bank_account')
                            @endif
                        </div>
                        <form onsubmit="return send_registration(this);" action="{{route('payment')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="card-payment">
                                <div class="row ">
                                    <h4 class="">Detail Pembayaran</h4>
                                    <div class="col-12">
                                        <div class="text-left" style="position: relative;">
                                            <img src="{{asset('assets/images/ic_pmb_unaki.png')}}" alt="" srcset="" style="width:100%;position: relative;">
                                            <div style="position: absolute;top: 40%;button:50%;left: 16px;">
                                                <h5 class="text-light d-inline">@rupiah($payment_registration)</h5> 
                                                <p class="text-light d-inline">
                                                    <br>({{ucwords($payment_registrations.' rupiah')}})
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($user_payment?->payment_type_id == \App\Models\PaymentType::XENDIT)
                            <div class="row mt-5">
                                <div class="col-12" style="width: 70%;">
                                    <p>
                                        <div class="btn-group" style="width:100%">
                                            <a href="{{route('payment.show', Auth::user()->id)}}" target="_blank" class="btn btn-success btn-block p-3">Bayar Sekarang</a>
                                        </div>
                                    </p>
                                </div>
                            </div>
                            @elseif($user_payment?->payment_type_id == \App\Models\PaymentType::UPLOAD_BUKTI)
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <p style="font-weight: 700;">
                                            Scan Bukti Bayar Formulir Pendaftaran
                                        </p>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-sm-3 mb-4 m-auto text-center">
                                        <img class="img-upload text-center" src="{{asset('assets/images/icons/image-upload.png')}}">
                                    </div>
                                    <div class="col-sm-9 mb-4">
                                    <label for="{{str_replace(' ', '-',strtolower(\App\Models\FileUpload::find(\App\Models\FileUpload::SCAN_BUKTI_PEMBAYARAN)->name))}}"><a type="button" class="file-upload-label btn-lg">Choose File</a></label>
                                    @if (Auth::user()->user_file_upload->where('file_upload_id', \App\Models\FileUpload::SCAN_BUKTI_PEMBAYARAN)->count() > 0)
                                    {{Auth::user()->user_file_upload->where('file_upload_id', \App\Models\FileUpload::SCAN_BUKTI_PEMBAYARAN)->first()->file_name}}
                                    <input hidden type="file" name="upload_file_scan" class="file-upload" id="{{str_replace(' ', '-',strtolower(\App\Models\FileUpload::find(\App\Models\FileUpload::SCAN_BUKTI_PEMBAYARAN)->name))}}" accept=".jpg,.jpeg,.png,.gif,.pdf" />
                                    @else
                                    <input hidden type="file" name="upload_file_scan" class="file-upload" id="{{str_replace(' ', '-',strtolower(\App\Models\FileUpload::find(\App\Models\FileUpload::SCAN_BUKTI_PEMBAYARAN)->name))}}" accept=".jpg,.jpeg,.png,.gif,.pdf" required/>
                                    @endif
                                        {!!\App\Models\FileUpload::find(\App\Models\FileUpload::SCAN_BUKTI_PEMBAYARAN)->description!!}
                                    </div>
                                </div>
                            @endif
                            <div class="col-12" style="width:70%">
                                @if($errors->any())
                                        {!! implode('', $errors->all('  <p class="text-danger">:message</p>')) !!}
                                @endif
                                <div style="text-align: center;display:inline-block;overflow: auto;
                                white-space: nowrap;
                                margin-top: 70px; width: 100%;">
                                    <div style='float: left;'>
                                        <a href="{{route('file_upload')}}" class="btn pl-5 pr-5 mb-3 btn-secondary">
                                            {{ __('Kembali') }}
                                        </a>
                                    </div>
                                    <div style='float: right;'>
                                        @if ($user_payment?->payment_type_id == \App\Models\PaymentType::XENDIT)
                                        <button  type="submit" class="btn btn-primary mb-3 pl-5 pr-5">
                                            Dashboard
                                        </button>
                                        @elseif($user_payment?->payment_type_id == \App\Models\PaymentType::UPLOAD_BUKTI)
                                        <button  type="submit" class="btn btn-primary mb-3 pl-5 pr-5">
                                            Kirim
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-7">
                            @include('penerimaan-mahasiswa-baru.contact_us')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
@endsection
@push('script')
<script>
    function send_registration(form){
        Swal.fire({
            title: 'Anda yakin submit pendaftaran sekarang ??',
            text: 'Pastikan telah mengisi data dengan benar, setelah dikirim anda tidak dapat mengubah data',
            input: 'checkbox',
            icon: "question",
            showCancelButton: true,
            cancelButtonText: 'Batal',
            inputValue: 0,
            inputPlaceholder: 'Saya yakin submit pendaftaran sekarang',
            confirmButtonText: 'Submit',
            inputValidator: function (result) {
                    if (result == 0){
                        toast.fire({
                        animation: true,
                        title: 'Silakan klik ceklis sebelum klik submit',
                        icon: 'warning'
                        });
                    }
            }
        }).then(function (isConfirmed) {
            if(isConfirmed.value == 1){
                form.submit();
                return true;
            }else{
                return false
            }
        });
        return false;
    }
    </script>
    
@endpush

