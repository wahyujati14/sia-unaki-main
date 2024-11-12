@extends('layouts.app',['title'=>'Ujian Online'])
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-body d-flex">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-sm-12">
                                <h1 class="selamat-mengerjakan">Selamat Mengerjakan Ujian</h1>
                                <p style="color:#9B9B9B" class="text-center">
                                        Pilih salah satu jawaban dari 4 pilihan yang ada, total {{$exam->questions->count()}} soal pilihan ganda,<br>Pastikan anda menjawab dengan teliti.
                                </p>
                        </div>
                    </div>
                    <form action="{{route('exam-questions.store')}}" method="POST">
                    @csrf
                        <div class="row p-4" id="question">
                            @include('exams.exam.component.question')
                        </div>
                        <div class="row p-2">
                            <div class="col-sm-12">
                                <p class="text-dark2">
                                Jika anda merasa tidak yakin dengan jawaban anda,<br>
                                anda bisa menyimpan sementara dan merubah nya nanti.
                                </p>
                            </div>
                        </div>
                        <div class="row mb-0" style="margin-top: 70px;">
                            <div class="col-md-12 text-right">
                                <a href="{{url('penerimaan-mahasiswa-baru/dashboard')}}" class="btn btn-primary btn-primary btn-lg" id="button-return">
                                    {{ __('Kembali ke Home') }}
                                </a>
                                <button type="submit" class="btn btn-primary btn-primary btn-lg" id="button-save">
                                    {{ __('Lanjut') }}
                                </button>
                                </form>
                                {{-- <form action="{{route('exam-questions.destroy', $exam->getQuestionRandom($exam->id))}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary btn-lg btn-secondary float-left">
                                        {{ __('Sebelumnya') }}
                                    </button>
                                </form> --}}
                            </div>
                        </div>
                </div>
                <div class="col-md-3 mt-2">
                    <div class="card-timer">
                        <p class="text-center text-dark mb-2">Sisa Waktu Ujian Anda</p>
                        <h2 class="text-center text-dark" style="font-weight: 700;font-size:40px">
                            {{-- <span>{{$start_time}}</span>
                            <span>{{$end_time}}</span> --}}
                            <span id="demo"></span>
                        </h2>
                    </div>
                    <div class="card-pilih-soal card p-3" id="question-map">
                        @include('exams.exam.component.question-map')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
@include('exams.component.script')
@endpush

