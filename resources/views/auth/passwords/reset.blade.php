@extends('layouts.app',['title'=>'Reset Password'])

@section('content')
<div class="container-body">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                <h2 class="mb-4">Reset Password</h2>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Masukan Password') }}</label>
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" >{{ __('Konfirmasi Password') }}</label>
                                <input name="password_confirmation" id="password-confirm" type="password" class="form-control form-control-lg">
                        </div>

                                <button type="submit" class="btn btn-accent">
                                    {{ __('Reset Password') }}
                                </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
