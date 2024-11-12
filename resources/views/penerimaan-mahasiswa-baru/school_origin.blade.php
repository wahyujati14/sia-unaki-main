@extends('layouts.app',['title'=>'Asal Sekolah Calon Mahasiswa Baru'])
@section('content')
<div class="ml-3 mr-3">
    <div class="row">
        <div class="col-md-9">
            <div class="container container-fluid mx-5">
                <div class="">
                    <div class="row">
                        <div class="col-4">
                            <h4 class="fw-600">PENDAFTARAN CALON MAHASISWA BARU {{date('Y')}}</h4>
                          </div>
                        <div class="col-3">
                            <p class="mb-1 text-sm text-lato fw-400">Step 2 of 5 - Asal Sekolah</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <form method="POST" action="{{ route('school_origin') }}">
                                @csrf
                                <div class="form-group mb-4 mt-5">
                                <label for="name" class="form-label">{{ __('ASAL SEKOLAH') }}</label>
                                    <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
                                    value="{{ @Auth::user()->school_origin->name ?? old('name')}}"  autocomplete="name" autofocus required placeholder="SMA 10 Semarang">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4 mt-5">
                                <label for="major" class="form-label">{{ __('JURUSAN SMU / SMK') }}</label>
                                    <input id="major" type="text" class="form-control form-control-lg @error('major') is-invalid @enderror" name="major"
                                    value="{{ @Auth::user()->school_origin->major ??  old('major')}}"  autocomplete="major" autofocus required placeholder="IPA / IPS / Informatika">
                                    @error('major')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4 mt-5">
                                <label for="graduation_year" class="form-label">{{ __('TAHUN LULUS SMU / SMK') }}</label>
                                    <input id="graduation_year" type="text" class="form-control number form-control-lg @error('graduation_year') is-invalid @enderror" name="graduation_year"
                                    value="{{ @Auth::user()->school_origin->graduation_year ??  old('graduation_year')}}"  autocomplete="graduation_year" autofocus required placeholder="2022">
                                    @error('graduation_year')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div  style="text-align: center;display:inline-block;overflow: auto;
                                white-space: nowrap;
                                margin-top: 70px; width: 100%;">
                                    <div class="float-start">
                                        <a href="{{route('registered')}}" class="btn btn-save text-white">
                                            {{ __('Kembali') }}
                                        </a>
                                    </div>
                                    <div class="float-end">
                                        <input type="submit" name="next" value="Lanjut" class="btn btn-submit text-white">
                                        <button type="submit" class="btn btn-save text-white">
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
