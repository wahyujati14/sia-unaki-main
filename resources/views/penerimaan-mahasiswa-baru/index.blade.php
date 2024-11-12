@extends('layouts.app',['title'=>'Identitas Calon Mahasiswa'])
@push('style')
@endpush()
@section('content')
<div class="ml-3 mr-3">
    <div class="row">
        <div class="col-md-9">
            <div class=" p-4">
                <div class="container container-fluid mx-5">
                    <div class="row">
                        <div class="col-4">
                            <h4 class="fw-600">PENDAFTARAN CALON MAHASISWA BARU {{date('Y')}}</h4>
                          </div>
                        <div class="col-3">
                            <p class="mb-1 text-sm text-lato fw-400">Step 1 of 5 - Identitas Calon Mahasiswa</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            {{-- <h2>PENDAFTARAN CALON MAHASISWA BARU {{date('Y')}}</h2> --}}
                            <form method="POST" action="{{ route('registered') }}">
                                @csrf
                                <input type="hidden" value="{{$check_periode->id}}" name="registration_periode_id">
                                <div class="form-group mb-4 mt-5">
                                <label for="name" class="form-label">{{ __('NAMA LENGKAP') }}</label>
                                    <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
                                    value="{{ @Auth::user()->name ?? old('name') }}"  autocomplete="name" disabled>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- <div class="form-group mb-4 mt-5">
                                <label for="nik" class="form-label">{{ __('NOMOR KTP') }}</label>
                                    <input id="nik" type="text" class="form-control form-control-lg nik @error('nik') is-invalid @enderror" name="nik"
                                    value="{{old('nik') ?? @Auth::user()->nik  }}"  autocomplete="nik">
                                    @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> --}}
                                <div class="row">
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="email" class="form-label">{{ __('EMAIL') }}</label>
                                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                                        value="{{ @Auth::user()->email ?? old('email') }}"  autocomplete="email" disabled>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="phone" class="form-label">{{ __('NOMOR TELPON') }}</label>
                                        <input id="phone" maxlength="13" type="text" class="form-control phone form-control-lg @error('phone') is-invalid @enderror" name="phone"
                                        autocomplete="phone" value="{{ old('phone') ?? @Auth::user()->phone }}" disabled>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="birth_place" class="form-label">{{ __('TEMPAT LAHIR') }}</label>
                                            <input id="birth_place" type="text" class="form-control form-control-lg @error('birth_place') is-invalid @enderror"
                                            name="birth_place" value="{{ @Auth::user()->user_information->birth_place ?? old('birth_place') }}"  autocomplete="birth_place" required>
                                            @error('birth_place')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="birth" class="form-label">{{ __('TANGGAL LAHIR') }}</label>
                                        <input id="birth" type="date" class="form-control form-control-lg @error('birth') is-invalid @enderror" name="birth"
                                        value="{{ @Auth::user()->user_information->birth ?? old('birth') }}"  autocomplete="birth" required>
                                        @error('birth')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="religion_id" class="form-label">{{ __('AGAMA') }}</label>
                                            <select id="religion_id"class="form-control form-control-lg @error('religion_id') is-invalid @enderror"
                                            name="religion_id"  autocomplete="religion_id" required>
                                            <option value="">---PILIH---</option>
                                            @foreach($religions as $value)
                                                @if (@Auth::user()->user_information->religion_id == $value->id)
                                                <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                                @else
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endif
                                            @endforeach
                                            </select>
                                            @error('religion_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="gender" class="form-label">{{ __('JENIS KELAMIN') }}</label>
                                            <select id="gender"class="form-control form-control-lg @error('gender') is-invalid @enderror"
                                            name="gender" value="{{ old('gender') }}" autocomplete="gender" required>
                                                <option value="">---PILIH---</option>
                                                <option value="MALE" {{(@Auth::user()->user_information->gender == 'MALE')?'selected':''}}>LAKI - LAKI</option>
                                                <option value="FEMALE" {{(@Auth::user()->user_information->gender == 'FEMALE')?'selected':''}}>PEREMPUAN</option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="parent_name" class="form-label">{{ __('NAMA AYAH / WALI') }}</label>
                                            <input id="parent_name" type="text" class="form-control form-control-lg @error('parent_name') is-invalid @enderror"
                                            name="parent_name" value="{{ @Auth::user()->user_information->parent_name ?? old('parent_name') }}"  autocomplete="parent_name" required>
                                            @error('parent_name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="biological_mother" class="form-label">{{ __('NAMA IBU KANDUNG') }}</label>
                                        <input id="biological_mother" type="text" class="form-control form-control-lg @error('biological_mother') is-invalid @enderror" name="biological_mother"
                                        value="{{ @Auth::user()->user_information->biological_mother ?? old('biological_mother') }}"  autocomplete="biological_mother" required>
                                        @error('biological_mother')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                        <label for="parent_phone" class="form-label">{{ __('NOMOR ORANG TUA YANG BISA DIHUBUNGI') }}</label>
                                        <input id="parent_phone" type="text" class="form-control phone  form-control-lg @error('parent_phone') is-invalid @enderror" name="parent_phone"
                                        value="{{ @Auth::user()->user_information->parent_phone ?? old('parent_phone') }}"  autocomplete="parent_phone" required>
                                        @error('parent_phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                                <div class="form-group mb-4">
                                        <label for="identity_address" class="form-label">{{ __('ALAMAT LENGKAP SESUAI KTP') }}</label>
                                        <textarea id="identity_address" type="text" class="form-control form-control-lg @error('identity_address') is-invalid @enderror" name="identity_address" autocomplete="identity_address" required>{{ @Auth::user()->user_information->identity_address ?? old('identity_address') }}</textarea>
                                        @error('identity_address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="province_id" class="form-label">{{ __('PROVINSI') }}</label>
                                            <select class="form-control select2 form-control-lg @error('province_id') is-invalid @enderror"
                                            name="province_id" id="province_id"  autocomplete="province_id" required>
                                                <option value="">---PILIH---</option>
                                                @foreach ($provincies as $provincy)
                                                @if (@Auth::user()->user_information->province_id == $provincy->id)
                                                <option value="{{$provincy->id}}" selected>{{$provincy->name}}</option>
                                                @else
                                                <option value="{{$provincy->id}}">{{$provincy->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('province_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="city_id" class="form-label">{{ __('KOTA / KABUPATEN') }}</label>
                                            <select id="city_id"class="form-control select2 form-control-lg @error('city_id') is-invalid @enderror"
                                            name="city_id"  autocomplete="city_id" required>
                                                <option value="">---PILIH---</option>
                                                @if (@Auth::user()->user_information->city_id)
                                                <option value="{{@Auth::user()->user_information->city_id}}" selected>{{@Auth::user()->user_information->city->name}}</option>
                                                @endif
                                            </select>
                                            @error('city_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="district_id" class="form-label">{{ __('KECAMATAN') }}</label>
                                            <select id="district_id"class="form-control  select2 form-control-lg @error('district_id') is-invalid @enderror"
                                            name="district_id"  autocomplete="district_id" required>
                                            <option value="">---PILIH---</option>
                                                @if (@Auth::user()->user_information->district_id)
                                                <option value="{{@Auth::user()->user_information->district_id}}" selected>{{@Auth::user()->user_information->district->name}}</option>
                                                @endif
                                            </select>
                                            @error('district_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="form-group mb-4 col-md-6">
                                        <label for="sub_district_id" class="form-label">{{ __('KELURAHAN / DESA') }}</label>
                                            <select id="sub_district_id"class="form-control select2 form-control-lg @error('sub_district_id') is-invalid @enderror"
                                            name="sub_district_id"  autocomplete="sub_district_id" required>
                                                <option value="">---PILIH---</option>
                                                @if (@Auth::user()->user_information->sub_district_id)
                                                <option value="{{@Auth::user()->user_information->sub_district_id}}" selected>{{@Auth::user()->user_information->sub_district->name}}</option>
                                                @endif
                                            </select>
                                            @error('sub_district_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group mb-4">
                                        <label for="current_address" class="form-label">{{ __('ALAMAT SEKARANG') }}</label>
                                        <textarea id="current_address" type="text" class="form-control form-control-lg @error('current_address') is-invalid @enderror" name="current_address" autocomplete="current_address">{{@Auth::user()->user_information->current_address ?? old('current_address')}}</textarea>
                                        @error('current_address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                                <div class="form-group mb-4">
                                        <label for="parent_address" class="form-label">{{ __('ALAMAT ORANG TUA / WALI') }}</label>
                                        <textarea id="parent_address" type="text" class="form-control form-control-lg @error('parent_address') is-invalid @enderror" name="parent_address" autocomplete="parent_address">{{@Auth::user()->user_information->parent_address ?? old('parent_address')}}</textarea>
                                        @error('parent_address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div> --}}
                                <div class="d-flex gap-2 justify-content-end mt-5">
                                    <div>
                                        <input type="submit" name="next" value="Lanjut" class="btn btn-submit text-white">
                                    </div>
                                    <button type="submit" class="btn btn-save text-white">
                                        {{ __('Simpan Sementara') }}
                                    </button>
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
<script>
$('#city_id').select2({
    ajax: {
    url: "{{url('api/v1/cities?')}}",
    dataType: 'json',
    type: 'GET',
    delay: 300,
    data: function (params) {
        var queryParameters = {
            name: params.term,
            province_id:$("#province_id").val(),
        }
        return queryParameters;
    },
    processResults: function (params) {
        return {
        results:  $.map(params.data.cities, function (item) {
                console.log(item)
                return {
                    text: item.name,
                    id: item.id
                }
            })
        };
    },
    cache: true
    }
});
$('#district_id').select2({
    ajax: {
    url: "{{url('api/v1/districts?')}}",
    type: 'GET',
    dataType: 'json',
    delay:300,
    data: function (params) {
        var queryParameters = {
            name: params.term,
            city_id:$("#city_id").val(),
        }
        return queryParameters;
    },
    processResults: function (params) {
        return {
            results:  $.map(params.data.districts, function (item) {
                return {
                    text: item.name,
                    id: item.id
                }
            })
        };
    },
    cache: true
    }
});
$('#sub_district_id').select2({
    ajax: {
    url: "{{url('api/v1/sub-districts?')}}",
    dataType: 'json',
    type: 'GET',
    delay: 300,
    data: function (params) {
        var queryParameters = {
            name: params.term,
            district_id:$("#district_id").val(),
        }
        return queryParameters;
    },
    processResults: function (params) {
        return {
            results:  $.map(params.data.sub_districts, function (item) {
                return {
                    text: item.name,
                    id: item.id
                }
            })
        };
    },
    cache: true
    }
});
</script>
@endpush