@extends('layouts.app',['title'=>'Home Pendaftaran Peneriman Mahasiswa Baru'])
@push('style')
<link rel="stylesheet" href="{{asset('css/daftar-ulang.css')}}">
@endpush
@section('content')
<section class="content text-lato">
    <div class="form-regist">
        <div class="position-relative">
            <div class="yellow position-absolute d-flex align-items-center p-4">
                <img width="100px" src="{{asset('assets/images/logos/UNAKI-Logo-Universitas-300x107.png')}}" alt="letter-logo" />
            </div>
            <div class="d-flex flex-column justify-items-center p-4 text-mons">
                <h2>FORMULIR REGISTRASI ULANG</h2>
                <h2>MAHASISWA BARU</h2>
                <h6>Tahun Akademik {{@Auth::user()->user_information->registration_periode->year}} / {{@Auth::user()->user_information->registration_periode->year + 1}}</h6>
            </div>
        </div>
        <div class="bdr-top"></div>
        <div class="bdr-bottom"></div>
        <div class="m-2 p-5">
            <h5 class="text-end text-mons fw-bold my-4">No. Formulir SKD / R1.2022.076</h5>
            <p>Yang bertanda tangan di bawah ini <span>:</span></p>
            <div class="px-5 pt-3">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td style="width: 20%">Nama Lengkap</td>
                            <td style="width: 1%">:</td>
                            <td>{{@Auth::user()->name}}</td>
                        </tr>
                        <tr>
                            <td>Tempat / Tgl Lahir</td>
                            <td>:</td>
                            <td>{{@Auth::user()->user_information->birth_place}} / {{date('d-m-Y', strtotime(@Auth::user()->user_information->birth))}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{@Auth::user()->user_information->identity_address}}</td>
                        </tr>
                        <tr>
                            <td>Kelurahan</td>
                            <td>:</td>
                            <td>{{@Auth::user()->user_information->sub_district->name}}</td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td>:</td>
                            <td>{{@Auth::user()->user_information->district->name}}</td>
                        </tr>
                        <tr>
                            <td>Nama Orang Tua</td>
                            <td>:</td>
                            <td>{{@Auth::user()->user_information->biological_mother}}</td>
                        </tr>
                        <tr>
                            <td>Alamat Orang Tua</td>
                            <td>:</td>
                            <td>{{@Auth::user()->user_information->parent_address}}</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Yang dinyatakan diterima pada ujian masuk Universitas AKI pada
                                <span class="ps-3">:</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Fakultas</td>
                            <td>:</td>
                            <td>{{@Auth::user()->study_program_selected()->first()->study_program->faculty->name}}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>:</td>
                            <td>{{@Auth::user()->study_program_selected()->first()->study_program->name}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p>Dengan ini menyatakan bahwa <span>:</span></p>
            <ol class="ms-3 px-5">
                <li>
                    Ijasah SLTA dan surat-surat lain yang saya gunakan untuk registrasi ulang di UNIVERSITAS AKI
                    adalah asli dan sah.
                </li>
                <li>
                    Akan mentaati semua peraturan dan ketentuan yang sedang dan akan berlaku di lingkungan
                    UNIVERSITAS AKI yang menyangkut bidang akademik, administrasi dan keuangan, dan
                    kemahasiswaan.
                </li>
                <li>
                    Akan selalu menjaga nama baik di dalam maupun di luar lingkungan kampus UNIVERSITAS AKI.
                </li>
                <li>
                    Akan menyampaikan aspirasi melalui saluran yang resmi secara musyawarah, kekeluargaan,
                    kebersamaan dan penuh tanggung jawab, selaman menjadi mahasiswa.
                </li>
                <li>
                    Bersedia menanggung segala akibat atau menerima sanksi baik secara administratif akademik,
                    maupun yuridis jika melanggar peraturan, atau membuat pernyataan yang tidak benar seperti
                    yang tertera pada butir 2 di atas.
                </li>
            </ol>
            <p>Surat pernyataan ini saya buat dengan sebenarnya dan dipergunakan dengan semestinya.</p>
            <div class="d-flex justify-content-end mt-5 py-5">
                <div>
                    <p>Semarang, {{date('d-m-Y')}}</p>
                    <p>Yang membuat pernyataan</p>
                    {{-- <canvas border=1 id="signature-pad" class="signature-pad" style="background: url('{{asset("assets/images/materai.png")}}')"></canvas> --}}
                    <img src="{{asset("assets/images/materai.png")}}" alt="">
                    <div class="text-center">
                        <p class="">{{@Auth::user()->name}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-upload">
        <h4 class="fw-bold text-mons">DAFTAR ULANG CALON MAHASISWA BARU 2022</h4>
        <p class="my-4">
            Lakukan daftar ulang sekarang untuk memastikan anda bersedia menjadi mahasiswa di Universitas AKI
        </p>
        <form action="{{route('re-registration')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex">
                <div class="mb-5 col-6">
                    @php
                        $user_payment = @Auth::user()->user_payments->where('type', \App\Models\UserPayment::TYPE_REREGISTRATION)->first();
                    @endphp
                    <select name="payment_type_id" id="" class="form-control" required {{($user_payment)?'disabled':''}}>
                        <option value="">PILIH</option>
                        @foreach ($payment_types as $payment_type)
                            @if ($user_payment?->payment_type_id == $payment_type->id)
                                <option value="{{$payment_type->id}}" selected>{{$payment_type->name}}</option>
                            @else
                                <option value="{{$payment_type->id}}">{{$payment_type->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    @php
                        $re_registration_payment = \App\Models\FileUpload::find(\App\Models\FileUpload::RE_REGISTRATION);
                    @endphp
                    <div class="mt-5 col-12 {{(!$user_payment)?'xendit':''}}">
                        <div class="card-payment">
                            <div class="row ">
                                <h4 class="">Detail Pembayaran</h4>
                                <div class="col-12">
                                    <div class="text-left" style="position: relative;">
                                        <img src="{{asset('assets/images/ic_pmb_unaki.png')}}" alt="" srcset="" style="width:100%;position: relative;">
                                        <div style="position: absolute;top: 40%;button:50%;left: 16px;">
                                            <h5 class="text-light d-inline">@rupiah(\App\Models\UserPayment::getAmount(\App\Models\UserPayment::TYPE_REREGISTRATION))</h5> 
                                            <p class="text-light d-inline">
                                                <br>({{ucwords(Terbilang::make(\App\Models\UserPayment::getAmount(\App\Models\UserPayment::TYPE_REREGISTRATION)).' rupiah') }}) Hanya Contoh
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-4 align-items-center">
                            <a href="{{route('re-registration.show', Auth::user()->id)}}" target="_blank" class="btn btn-success btn-block p-3">Bayar Sekarang</a>
                        </div>
                    </div>
                    <div class="mt-5 col-12 {{(!$user_payment)?'upload-bukti':''}}">
                        <label class="form-label text-mons fw-700 mb-3">{{$re_registration_payment->name}}</label>
                        <div class="d-flex gap-4 align-items-center">
                            <div>
                                <img class="img-upload text-center" src="{{asset('assets/images/icons/image-upload.png')}}">
                            </div>
                            <div>
                                <label for="{{str_replace(' ', '-',strtolower($re_registration_payment->name))}}"><a type="button" class="file-upload-label btn-lg">Choose File</a></label>
                                <input hidden type="file" name="upload_bukti" class="file-upload upload-bukti-input" id="{{str_replace(' ', '-',strtolower($re_registration_payment->name))}}" accept=".{{implode(',.' , json_decode($re_registration_payment->type))}}"/>
                                <p class="text-lato mt-2 mb-0 text-sm">
                                    file yang dapat di upload berekstensi {{$re_registration_payment->type}} <br/>
                                    (maksimum ukuran file {{$re_registration_payment->size}} MB)
                                </p>
                            </div>
                        </div>
                        @include('penerimaan-mahasiswa-baru.bank_account')
                    </div>
                </div>
                @php
                    $pas_photo = \App\Models\FileUpload::find(\App\Models\FileUpload::PAS_PHOTO);
                @endphp
                <div class="mb-5 col-6">
                    <label class="form-label text-mons fw-700 mb-3">{{$pas_photo->name}}</label>
                    <div class="d-flex gap-4 align-items-center">
                        <div>
                            <img class="img-upload text-center" src="{{asset('assets/images/icons/image-upload.png')}}">
                        </div>
                        <div>
                            <label for="{{str_replace(' ', '-',strtolower($pas_photo->name))}}"><a type="button" class="file-upload-label btn-lg">Choose File</a></label>
                            {{@Auth::user()->user_file_upload->where('file_upload_id', \App\Models\FileUpload::PAS_PHOTO)->first()->file_name}}
                            <input hidden type="file" name="pas_photo" class="file-upload" id="{{str_replace(' ', '-',strtolower($pas_photo->name))}}" accept=".{{implode(',.' , json_decode($pas_photo->type))}}" required/>
                            <p class="text-lato mt-2 mb-0 text-sm">
                                file yang dapat di upload berekstensi {{$pas_photo->type}} <br/>
                                (maksimum ukuran file {{$pas_photo->size}} MB)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @if (@!Auth::user()->user_reregistration)
            <div class="text-center">
                <button type="submit" class="btn-acc">Kirim</button>
            </div>
            @endif
        </form>
    </div>
</section>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
    $( document ).ready(function() {
        // resizeCanvas();
        $('.xendit').hide();
        $('.upload-bukti').hide();
        $('select').on('change', function() {
            if(this.value == {!!\App\Models\PaymentType::XENDIT!!}){
                $('.upload-bukti-input').prop('required',false);
                $('.xendit').show();
                $('.upload-bukti').hide();
            } else if(this.value == {!!\App\Models\PaymentType::UPLOAD_BUKTI!!}){
                $('.upload-bukti').show();
                $('.upload-bukti-input').prop('required',true);
                $('.xendit').hide();
            }else{
                $('.xendit').hide();
                $('.upload-bukti').hide();
                alert('Tipe Pembayaran tidak di temukan, Silahkan pilih salah satu');
            }
        });
    });

    function resizeCanvas() {
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = 190 * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }
    var canvas = document.getElementById('signature-pad');
    
    //warna dasar signaturepad
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)'
    });

    //saat tombol clear diklik maka akan menghilangkan seluruh tanda tangan
    document.getElementById('clear').addEventListener('click', function () {
        signaturePad.clear();
    });

    //saat tombol undo diklik maka akan mengembalikan tanda tangan sebelumnya
    document.getElementById('undo').addEventListener('click', function () {
        var data = signaturePad.toData();
        if (data) {
            data.pop(); // remove the last dot or line
            signaturePad.fromData(data);
        }
    });

    //saat tombol change color diklik maka akan merubah warna pena
    document.getElementById('change-color').addEventListener('click', function () {

        //jika warna pena biru maka buat menjadi hitam dan sebaliknya
        if(signaturePad.penColor == "rgba(0, 0, 255, 1)"){

            signaturePad.penColor = "rgba(0, 0, 0, 1)";
        }else{
            signaturePad.penColor = "rgba(0, 0, 255, 1)";
        }
    })
</script>
@endpush
