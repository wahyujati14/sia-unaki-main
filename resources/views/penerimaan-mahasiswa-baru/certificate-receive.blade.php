@extends('layouts.app',['title'=>'Home Pendaftaran Peneriman Mahasiswa Baru'])
@push('style')

@endpush
@section('content')
@include('penerimaan-mahasiswa-baru.email-certificate-receive', ['name' => Auth::user()->name, 'user' => Auth::user()])
@endsection
@push('script')
@endpush
