@extends('layouts.app',['title'=>'Daftar Akun Peneriman Mahasiswa Baru (PMB)'])
@push('style')
    <style>
        section {
        background-image: url("{{url('/assets/images/banner-login.png')}}") !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
        padding-bottom: 8rem !important;
        background-position: center;
      }
    </style>
@endpush
@section('content')
  <div class="row">
    <div class="col-6 ms-auto">
        <div class="card-body" style="margin-top: 5%;">
            <h2>Selamat Datang<br>Di PMB UNAKI</h2>
            <p>Silakan mendaftar untuk mengikuti Pendaftaran Mahasiswa Baru</p>
          <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
              <label for="name" class="form-label">{{ __('NAMA LENGKAP') }}</label>
                <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
                  value="{{ old('name') }}"  autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="row">
                <div class="form-group mb-4 col-md-6">
                <label for="email" class="form-label">{{ __('EMAIL') }}</label>
                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}"  autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-4 col-md-6">
                <label for="phone" class="form-label">{{ __('NOMOR TELPON') }}</label>
                    <input id="phone" maxlength="13" type="text" class="form-control phone form-control-lg @error('phone') is-invalid @enderror" name="phone"
                    autocomplete="phone" value="{{ old('phone') }}">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6 mb-4">
                <label for="password" class="form-label">{{ __('KATA SANDI') }}</label>
                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                    name="password"  autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-sm-6 mb-4">
                <label for="password-confirm"
                    class="form-label">{{ __('KONFIRMASI KATA SANDI') }}</label>
                    <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation"
                    autocomplete="new-password">
                </div>
            </div>

            <div class="form-group mb-0 mt-4">
                <button type="submit" class="btn btn-primary btn-register">
                {{ __('Register') }}
                </button>
            </div>
            </div>
          </form>
        </div>
    </div>
  </div>
@endsection
