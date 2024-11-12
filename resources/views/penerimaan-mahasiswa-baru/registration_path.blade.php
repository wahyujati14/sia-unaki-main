@extends('layouts.app',['title'=>'Jalur Pendaftaran Calon Mahasiswa'])
@section('content')
<div class="ml-3 mr-3">
    <div class="row">
        <div class="col-9">
            <div class="container container-fluid mx-5">
                <div class="container-body">
                    <div class="row">
                        <div class="col-4">
                            <h4 class="fw-600">PENDAFTARAN CALON MAHASISWA BARU {{date('Y')}}</h4>
                          </div>
                        <div class="col-3">
                            <p class="mb-1 text-sm text-lato fw-400">Step 3 of 5 - Jalur Pendaftaran</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <form method="POST" action="{{ route('registration_path') }}">
                                @csrf
                                <div class="form-group col-md-12">
                                    <label for="name" class="form-label">{{ __('JALUR PENDAFTARAN') }}</label>
                                    <div class="row p-3">
                                        @foreach($registration_paths as $value)
                                        <div class="col-sm-12">
                                            @if (@Auth::user()->user_information->registration_path_id == $value->id)    
                                                <input  value="{{$value->id}}" type="radio" name="registration_path_id" checked>
                                            @else
                                                <input  value="{{$value->id}}" type="radio" name="registration_path_id">
                                            @endif
                                            <label class="text-dark">{{$value->name}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('first_study_program')
                                    <div>
                                        @error('registration_path_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @enderror
                                    <div class="p-0 mb-3">
                                        <div class="col-sm-12 p-0">
                                            <p class="text-dark">untuk informasi jalur pendidikan silahkan klik link berikut <a class="text-accent text-decoration-none">Info Jalur Pendidikan.</a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4 col-md-12">
                                    <label for="first_study_program" class="form-label">{{ __('PROGRAM STUDI PILIHAN PERTAMA') }}</label>
                                    <select id="first_study_program" type="text" class="form-control form-control-lg @error('first_study_program') is-invalid @enderror"
                                    name="first_study_program" required>
                                        <option></option>
                                        @foreach($study_programs as $value)
                                        @if (@Auth::user()->user_study_program()->where('type', 'FIRST')->first()->study_program_id == $value->id)    
                                            <option  value="{{$value->id}}" selected>{{$value->name}}
                                        @else
                                            <option  value="{{$value->id}}">{{$value->name}}
                                        @endif
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('first_study_program')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4 col-md-12">
                                    <label for="second_study_program" class="form-label">{{ __('PROGRAM STUDI PILIHAN KEDUA') }}</label>
                                        <select id="second_study_program" type="text" class="form-control form-control-lg @error('second_study_program') is-invalid @enderror"
                                        name="second_study_program" required>
                                            <option></option>
                                            @foreach($study_programs as $value)
                                            @if (@Auth::user()->user_study_program()->where('type', 'SECOND')->first()->study_program_id == $value->id)    
                                                <option  value="{{$value->id}}" selected>{{$value->name}}
                                            @else
                                                <option  value="{{$value->id}}">{{$value->name}}
                                            @endif
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('second_study_program')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>

                                <div style="text-align: center;display:inline-block;overflow: auto;
                                white-space: nowrap;
                                margin-top: 70px; width: 100%;">
                                    <div style='float: left;'>
                                        <a href="{{route('school_origin')}}" class="btn btn-secondary">
                                            {{ __('Kembali') }}
                                        </a>
                                    </div>
                                    <div style='float: right;'>
                                        <input type="submit" name="next" value="Lanjut" class="btn btn-primary mb-3">
                                        <button type="submit" class="btn btn-secondary mb-3">
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
