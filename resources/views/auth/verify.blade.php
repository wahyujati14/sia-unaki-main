@extends('layouts.app',['title'=>'Verifikasi Email'])

@section('content')
<div class="container-body">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                <h3>Verifikasi Email Anda</h3>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </div>
                    @endif

                    <p class="mb-0">Sebelum melanjutkan, harap periksa email Anda untuk verifikasi. Jika anda tidak menerima email</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="text-accent btn p-0  m-0">Klik untuk mengirim ulang verifikasi email</button>.
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
