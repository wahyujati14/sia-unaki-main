@extends('layouts.app',['title'=>'File Upload'])
@section('content')
<div class="ml-3 mr-3">
    <div class="row">
        <div class="col-md-9">
            <div class="container container-fluid mx-5">
                <div class="-body">
                    <div class="row">
                        <div class="col-4">
                            <h4 class="fw-600">PENDAFTARAN CALON MAHASISWA BARU {{date('Y')}}</h4>
                          </div>
                        <div class="col-3">
                            <p class="mb-1 text-sm text-lato fw-400">Step 4 of 5 - File Upload</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-7">
                            <p>
                                Pada bagian ini anda akan diminta untuk mengupload beberapa file yang dibutuhkan untuk proses pendaftaran kuliah.
                                Silahkan klik tombol simpan sementara di bagian bawah jika anda membutuhkan waktu untuk mempersiapkan file agar dapat
                                melanjutkan isi yang telah anda buat sebelumnya.
                                Link untuk melanjutkan isian akan dikirimkan ke alamat email yang telah anda masukan sebelumnya.
                            </p>
                        </div>
                        <div class="col-sm-7">
                            <form 
                            {{-- onsubmit="return send_registration(this);"  --}}
                            method="POST" action="{{ url('penerimaan-mahasiswa-baru/file-upload') }}" enctype="multipart/form-data">
                                @csrf
                                @foreach ($file_uploads as $file_upload)
                                    <div class="row mt-3">
                                        <div class="col-sm-12">
                                            <p style="font-weight: 700;">
                                            {{($file_upload->name)}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-sm-3 mb-4 m-auto text-center">
                                            <img class="img-upload text-center" src="{{asset('assets/images/icons/image-upload.png')}}">
                                        </div>
                                        <div class="col-sm-9 mb-4">
                                        <label for="{{str_replace(' ', '-',strtolower($file_upload->name))}}"><a type="button" class="file-upload-label btn-lg">Choose File</a></label>
                                        @if (Auth::user()->user_file_upload->where('file_upload_id', $file_upload->id)->count() > 0)
                                        {{@Auth::user()->user_file_upload->where('file_upload_id', $file_upload->id)->first()->file_name}}
                                        <input hidden type="file" name="file[]" class="file-upload" id="{{str_replace(' ', '-',strtolower($file_upload->name))}}" accept=".jpg,.jpeg,.png,.gif,.pdf"/>
                                        @else
                                        <input hidden type="file" name="file[]" class="file-upload" id="{{str_replace(' ', '-',strtolower($file_upload->name))}}" accept=".jpg,.jpeg,.png,.gif,.pdf" required/>
                                        @endif
                                            {!!$file_upload->description!!}
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-sm-12 mt-3">
                                        <p style="font-weight: 700;">
                                        Darimana anda mengetahui tentang Universitas AKI?
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            @foreach($informations as $value)
                                            <div class="col-sm-6">
                                                @if(in_array($value->id, Auth::user()->user_information_source->pluck('information_source_id')->toArray()))
                                                <input  value="{{$value->id}}" type="checkbox" name="information_source[]" checked>
                                                @else
                                                <input  value="{{$value->id}}" type="checkbox" name="information_source[]">
                                                @endif
                                                <label class="text-dark">{{$value->name}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <p class="text-dark" style="font-size: 11px;font-weight: 400;">* Boleh pilih lebih dari satu</p>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row form-group">
                                            <label for="">Pilih Metode Pembayaran</label>
                                            <select name="payment_type_id" id="" class="form-control" required>
                                                <option value="">PILIH</option>
                                                @php
                                                    $user_payment = @Auth::user()->user_payments->where('type', \App\Models\UserPayment::TYPE_REGISTRATION)->first();
                                                @endphp
                                                @foreach ($payment_types as $payment_type)
                                                    @if ($user_payment?->payment_type_id == $payment_type->id)
                                                        <option value="{{$payment_type->id}}" selected>{{$payment_type->name}}</option>
                                                    @else
                                                        <option value="{{$payment_type->id}}">{{$payment_type->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->any())
                                        {!! implode('', $errors->all('  <p class="text-danger">:message</p>')) !!}
                                @endif
                                <div style="text-align: center;display:inline-block;overflow: auto;
                                white-space: nowrap;
                                margin-top: 70px; width: 100%;">
                                    <div style='float: left;'>
                                        <a href="{{route('school_origin')}}" class="btn mb-3 btn-secondary">
                                            {{ __('Kembali') }}
                                        </a>
                                    </div>
                                    <div style='float: right;'>
                                        <input type="submit" name="next" value="Lanjut" class="btn btn-primary mb-3">
                                        <button type="submit" class="btn mb-3 btn-secondary">
                                            {{ __('Simpan Sementara') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
    
@endpush

