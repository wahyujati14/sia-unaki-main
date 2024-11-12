@extends('layouts.app',['title'=>'Reset Password'])

@section('content')
<div class="container-body">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            Link Reset Password telah dikirim ke email anda
                        </div>
                    @endif
                    <h2 class="mb-4">Reset Password</h2>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukan email anda">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Email yang anda masukan tidak terdaftar</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-accent">
                                    {{ __('Kirim Link Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
