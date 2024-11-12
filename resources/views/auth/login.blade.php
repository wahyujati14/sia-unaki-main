@extends('layouts.app',['title'=>'Login Peneriman Mahasiswa Baru (PMB)'])
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
        <div class="card-body card-login">
            <h2>Selamat Datang<br>Di SISTA UNAKI</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mt-4">
                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email" autofocus required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>Email atau password tidak sesuai</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Katasandi" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @if (Route::has('password.request'))
                        <a class="btn text-accent float-right" href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif
                </div>
                <div class="row mb-1" style="margin-top: 70px; display:flex">
                    <div class="col-md-6 mb-2">
                        <button type="submit" class="btn btn-primary btn-login pl-5 pr-5">
                            {{ __('Login') }}
                        </button>
                        <a href="#" class="btn btn-outline btn-login text-primary">
                            {{ __('Login Dosen ?') }}
                        </a>
                    </div>
                </div>
                <div>
                    <p class="text-dark2">Belum Punya Akun ? <a type="button" href="{{url('register')}}" class="text-primary text-decoration-none"> Buat Akun</a></p>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection

