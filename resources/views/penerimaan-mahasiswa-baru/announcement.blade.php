@php
    $user_payment = Auth::user()->user_payments->where('type', App\Models\UserPayment::TYPE_REGISTRATION)->first();
    $exam_path = (Auth::user()->user_information->registration_path->id == \App\Models\RegistrationPath::JALUR_TEST);
    $exam = Auth::user()->user_information?->registration_path?->exam_registration_path?->exam;
    $start_time = $exam->schedule;
    $minutes = strtotime( "+".date('i', strtotime($exam->duration))." minutes", strtotime($start_time));
    $end_time = date('Y-m-d H:i:s', strtotime("+".date('H', strtotime($exam->duration))." hours", $minutes));
    $exam_done = strtotime($end_time) < strtotime(date('Y-m-d H:i:s'));

    $scan = \App\Models\FileUpload::SCAN_BUKTI_PEMBAYARAN;
    $is_verification = Auth::user()->user_file_upload()->where('file_upload_id', $scan)->first()?->file_verification;

    $user_exam = \App\Models\ExamUserSession::where('user_id', Auth::user()->id)->first();
    if($user_exam){
        if(date('N', strtotime($user_exam->created_at)) >= 4){
            $date_exam = Carbon\Carbon::parse(date('Y-m-d H:i:s', strtotime($user_exam->created_at.' + 7 days')));
        }else{
            $date_exam = $user_exam->created_at;
        }
        $date_exam->modify('Next Saturday');
    }
    $certificate_receive = Auth::user()->certificate_receive;
@endphp
{{-- Jika Pembayaran Sudah di konfirmasi --}}
@if ($user_payment->is_validate && $user_payment->status == \App\Models\UserPayment::STATUS_PAID)
    {{-- Jika ikut ujian --}}
    @if ($exam_path) 
        {{-- Jika Ada Ujian --}}
        @if ($exam->is_active)
            {{-- Jika Ujian Blm dimulai --}}
            @if (strtotime($exam->schedule) > strtotime(date('Y-m-d H:i:s')))
                <h1>Selamat Datang di UNAKI</h1>
                <div class="row card-exam m-auto">
                    <div class="col-sm-2">
                        <img src="{{asset('assets/images/img_jadwal_test.png')}}" class="img img-fluid" style="max-width: 100%; height: 100%; " alt="">
                    </div>
                    <div class="col-sm-10">
                        <h1 class="text-light text-left m-2">Ujian Online </h1>
                        <p class="text-light m-2" style="font-size: 20px;">
                            Ujian online akan dilaksanakan dengan waktu serentak, pastikan anda sudah menyiapkan diri sebaik mungkin untuk mengikuti ujian
                        </p>
                        <p class="text-light m-2" style="font-size: 20px;">
                            Waktu Ujian {{$exam->schedule}}
                        </p>
                    </div>
                </div>
            @else
                @if($user_exam)
                    {{-- Jika Ujian Sudah Dimulai --}}
                    @if ($user_exam && !$exam_done)
                        {{-- Jika Ujian Sedang Berlangsung --}}
                        <h1>Selamat Datang di UNAKI</h1>
                        <div class="row card-exam m-auto">
                            <div class="col-sm-2">
                                <img src="{{asset('assets/images/img_jadwal_test.png')}}" class="img img-fluid" style="max-width: 100%; height: 100%; " alt="">
                            </div>
                            <div class="col-sm-10">
                                <h1 class="text-light text-left m-2">Ujian Online </h1>
                                <p class="text-light m-2" style="font-size: 20px;">
                                    Ujian online akan dilaksanakan dengan waktu serentak, pastikan anda sudah menyiapkan diri sebaik mungkin untuk mengikuti ujian
                                </p>
                                @if(Auth::user()->user_exam->user_answers->count() < $exam->questions->count())
                                <a href="{{route('exam-questions.index')}}" class="btn btn-outline-light text-light m-2">Ikuti Ujian Sekarang</a>
                                @else
                                <p class="text-light m-2" style="font-size: 12px;">
                                Ujian Telah Selesai di kerjakan silahkan menunggu penilaian
                                </p>
                                @endif
                            </div>
                        </div>
                    @elseif($user_exam && $exam_done)
                        @if($user_exam->is_success)
                            {{-- Jika Ujian berhasil atau lolos--}}
                            <h1>PENGUMUMAN</h1>
                            <div class="row m-auto">
                                <div class="col-sm-12">
                                    <center>
                                        <img src="{{asset('assets/images/icons/lolos-ujian.png')}}" class="text-center" style="max-width: 80%; height: 80%; " alt="">
                                    </center>
                                </div>
                                <div class="col-sm-12">
                                    <h1 class="text-center m-2">Selamat Anda Lolos </h1>
                                    <p class="text-center m-2" style="font-size: 20px;">
                                        Anda berhasil dalam melalui ujian, silahkan mengikuti proses selanjutnya
                                    </p>
                                    @if (@!$certificate_receive)
                                    {{-- Jika mengajukan skd --}}
                                    <center>
                                        <form action="{{route('certificate-receive')}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Ajukan SKD</button>
                                        </form>
                                    </center>
                                    @elseif($certificate_receive && $certificate_receive->submission <= 0)
                                    {{-- Jika proses skd --}}
                                    <center>
                                        <button type="submit" class="btn btn-secondary" disabled>SKD sedang di verifikasi</button>
                                    </center>
                                    @elseif($certificate_receive && $certificate_receive->submission > 0)
                                    {{-- Jika verifikasi skd --}}
                                    {{-- <p class="text-center m-2" style="font-size: 20px;">
                                        SKD (Surat Keterangan Diterima) sudah di kirim melalui email, silahkan lakukan proses daftar ulang, jika belum menerima email silahkan lakukan pengajuan ulang
                                    </p> --}}
                                    <center>
                                        {{-- <form action="{{route('skd')}}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Ajukan SKD Ulang</button>
                                        </form> --}}
                                        @if (@Auth::user()->user_reregistration)
                                            @if (Auth::user()->user_reregistration->is_approve && Auth::user()->user_reregistration->status == 'VALID')
                                            Pendaftaran Ulang sudah di konfirmasi, silahkan login menggunakan aplikasi
                                            @elseif(!Auth::user()->user_reregistration->is_approve && Auth::user()->user_reregistration->status == 'PROSES')
                                            <a href="#" class="btn btn-secondary mb-2">Sedang Di proses admin</a>
                                            <a href="{{route('certificate-receive')}}" class="btn btn-primary mb-2">Surat Keterangan Diterima</a>
                                            @elseif(!Auth::user()->user_reregistration->is_approve && Auth::user()->user_reregistration->status == 'FAILED')
                                            Pendaftaran Ulang ditolak <br>
                                            <a href="{{route('re-registration')}}" class="btn btn-primary mb-2">Ajukan Daftar Ulang Lagi</a>
                                            <a href="{{route('certificate-receive')}}" class="btn btn-primary mb-2">Surat Keterangan Diterima</a>
                                            @elseif(!Auth::user()->user_reregistration->is_approve)
                                            Pendaftaran Ulang ditolak <br>
                                            <a href="{{route('re-registration')}}" class="btn btn-primary mb-2">Ajukan Daftar Ulang Lagi</a>
                                            <a href="{{route('certificate-receive')}}" class="btn btn-primary mb-2">Surat Keterangan Diterima</a>
                                            @else
                                            <a href="{{route('re-registration')}}" class="btn btn-primary mb-2">Daftar Ulang</a>
                                            <a href="{{route('certificate-receive')}}" class="btn btn-primary mb-2">Surat Keterangan Diterima</a>
                                            @endif
                                        @else
                                        <a href="{{route('re-registration')}}" class="btn btn-primary mb-2">Daftar Ulang</a>
                                        <a href="{{route('certificate-receive')}}" class="btn btn-primary mb-2">Surat Keterangan Diterima</a>
                                        @endif
                                    </center>
                                    @endif
                                </div>
                            </div>
                        @elseif($user_exam->is_failed)
                            {{-- Jika Ujian gagal atau tidak lolos--}}
                            <h1>PENGUMUMAN</h1>
                            <div class="row m-auto">
                                <div class="col-sm-12">
                                    <p class="text-light m-2" style="font-size: 20px;">
                                        Anda Tidak Lolos
                                    </p>
                                    <center>
                                        <img src="{{asset('assets/images/icons/gagal-ujian.png')}}" class="text-center" style="max-width: 80%; height: 80%; " alt="">
                                    </center>
                                </div>
                                <div class="col-sm-12">
                                    <p class="text-center m-2" style="font-size: 20px;">
                                        Anda Tidak memenuhi syarat minimal ujian untuk masuk ke UNAKI, anda di berikan 1X kesempatan mengulang ujian tanpa perlu membayar formulir pendaftaran lagi, Batas melakukan ujian ulang adalah 1X24 Jam atau jam 12 malam ini
                                    </p>
                                    <center>
                                        @php
                                            $exam_count = \App\Models\ExamUserSession::where('user_id', Auth::user()->id)->withTrashed()->get();
                                        @endphp
                                        @if ($exam_count->count() < 2)
                                            @if (date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($exam_count->first()->deleted_at)).'00:00:00'. '+ 1 days')) > date('Y-m-d H:i:s'))
                                            <button type="button" class="btn btn-danger">Tes ulang tidak dapat dilakukan</button>
                                            @else
                                            <form action="{{route('reexam')}}">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Ikuti Tes Ulang Sekarang</button>
                                            </form>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-danger">Tes ulang tidak dapat dilakukan</button>
                                        @endif
                                    </center>
                                </div>
                            </div>
                        @else
                            <div class="row card-exam m-auto">
                                <div class="col-sm-2">
                                    <img src="{{asset('assets/images/img_jadwal_test.png')}}" class="img img-fluid" style="max-width: 100%; height: 100%; " alt="">
                                </div>
                                <div class="col-sm-10">
                                    <h1 class="text-light text-left m-2">Ujian Online </h1>
                                    <p class="text-light m-2" style="font-size: 20px;">
                                        Ujian online akan dilaksanakan dengan waktu serentak, pada hari 
                                        <span style="color:darkblue">
                                            Sabtu, {{date('d', strtotime($date_exam))}} {{date('M', strtotime($date_exam))}} {{date('Y', strtotime($date_exam))}}, 
                                            {{$user_exam->exam_session->name}} ({{$user_exam->exam_session->start_time}} ~ {{$user_exam->exam_session->end_time}})
                                        </span>
                                        pastikan anda sudah menyiapkan diri sebaik mungkin untuk mengikuti ujian
                                        @php
                                            $startDate = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($date_exam)).$user_exam->exam_session->start_time));
                                            $endDate = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($date_exam)).$user_exam->exam_session->end_time));
                                            $check = Carbon\Carbon::now()->between($startDate, $endDate);
                                        @endphp
                                        <br>
                                        @if($check && @count(Auth::user()->exam_user_session->exam_user_answers??[]) != $exam->questions->count())
                                        <a href="{{route('exam-questions.index')}}" class="btn btn-outline-light text-light m-2">Ikuti Ujian Sekarang</a>
                                        @elseif(@count(Auth::user()->exam_user_session->exam_user_answers??[]) == $exam->questions->count())
                                        <p class="text-light m-2" style="font-size: 10px;">
                                            Ujian Telah Selesai di kerjakan silahkan menunggu penilaian
                                        </p>
                                        @else
                                        <a href="{{route('exam-questions.index')}}" class="btn btn-outline-light text-light m-2">Ikuti Ujian Sekarang</a>
                                        <p class="text-light m-2" style="font-size: 10px;">
                                        Ujian Telah Selesai di kerjakan silahkan menunggu penilaian
                                        </p>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif
                    @else
                    {{-- Jika Ujian sudah di kerjakan--}}
                    <h1>Selamat Datang di UNAKI</h1>
                    <div class="row card-exam m-auto">
                        <div class="col-sm-2">
                            <img src="{{asset('assets/images/img_jadwal_test.png')}}" class="img img-fluid" style="max-width: 100%; height: 100%; " alt="">
                        </div>
                        <div class="col-sm-10">
                            <h1 class="text-light text-left m-2">Ujian Online </h1>
                            <p class="text-light m-2" style="font-size: 20px;">
                                Ujian online akan dilaksanakan dengan waktu serentak, pastikan anda sudah menyiapkan diri sebaik mungkin untuk mengikuti ujian
                            </p>
                            <p class="text-light m-2" style="font-size: 20px;">
                                Ujian anda sudah selesai dilakukan silahkan tunggu hasil pengumuman ujian
                            </p>
                        </div>
                    </div>
                    @endif
                @else
                    @if (strtotime($exam->schedule) < strtotime(date('Y-m-d H:i:s')))
                        <h1>Selamat Datang di UNAKI</h1>
                        <div class="row card-exam m-auto">
                            <div class="col-sm-2">
                                <img src="{{asset('assets/images/img_jadwal_test.png')}}" class="img img-fluid" style="max-width: 100%; height: 100%; " alt="">
                            </div>
                            <div class="col-sm-10">
                                <h1 class="text-light text-left m-2">Ujian Online </h1>
                                <p class="text-light m-2" style="font-size: 20px;">
                                    Ujian online akan dilaksanakan dengan waktu serentak, pastikan anda sudah menyiapkan diri sebaik mungkin untuk mengikuti ujian
                                </p>
                                <p class="text-light m-2">Silahkan pilih sesi ujian anda</p>
                                @foreach (\App\Models\ExamSession::get() as $exam_session)
                                    <form action="{{route('exam_session')}}" method="POST" class="d-inline ml-2">
                                        @csrf
                                        <input type="hidden" name="exam_session_id" id="" value="{{$exam_session->id}}">
                                        <button class="btn btn-success confirm">{{$exam_session->name}}</button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <h1>Selamat Datang di UNAKI</h1>
                        <div class="row card-exam m-auto">
                            <div class="col-sm-2">
                                <img src="{{asset('assets/images/img_jadwal_test.png')}}" class="img img-fluid" style="max-width: 100%; height: 100%; " alt="">
                            </div>
                            <div class="col-sm-10">
                                <h1 class="text-light text-left m-2">Ujian Online </h1>
                                <p class="text-light m-2" style="font-size: 20px;">
                                    Ujian online akan dilaksanakan dengan waktu serentak, pastikan anda sudah menyiapkan diri sebaik mungkin untuk mengikuti ujian
                                </p>
                                <p class="text-light m-2" style="font-size: 20px;">
                                    Waktu Ujian {{$exam->schedule}}
                                </p>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        @else
            {{-- Jika Tidak ada ujian yang aktif pada periode ini --}}
            <h1>Selamat Datang di UNAKI</h1>
            <div class="row card-exam m-auto">
                <div class="col-sm-2">
                    <img src="{{asset('assets/images/img_jadwal_test.png')}}" class="img img-fluid" style="max-width: 100%; height: 100%; " alt="">
                </div>
                <div class="col-sm-10">
                    <h1 class="text-light text-left m-2">Ujian Online </h1>
                    <p class="text-light m-2" style="font-size: 20px;">
                        Maaf Ujian online belum tersedia silahkan tunggu informasi pembukaan pendaftaran pada website resmi kami <a target="_blank" href="https://www.unaki.ac.id/">link</a>
                    </p>
                </div>
            </div>
        @endif
    @else
        {{-- Jika Sudah di verifikasi admin --}}
        <h1>Selamat Datang di UNAKI</h1>
        <div class="card-body">
            <p class="sub-title-home">
                Pendaftaran anda sudah <span class="text-primary">diverifikasi oleh admin</span>, Harap cek email secara berkala<br> untuk mendapatkan informasi lebih lanjut
            </p>
        </div>
    @endif
@else
{{-- Jika Belum di verifikasi --}}
<h1>Selamat Datang di UNAKI</h1>
<div class="card-body">
    <p class="sub-title-home">
        Pendaftaran anda sedang <span class="text-primary">diproses oleh admin</span>, Segera Selesaikan Pembayaran anda dan cek email secara berkala<br> untuk mendapatkan informasi lebih lanjut <br><small>Abaikan pesan berikut jika pembayaran sudah di lakukan</small>
        <a href="{{route('payment')}}">Check Pembayaran</a>
    </p>
</div>
@endif

@include('admin.layouts.confirm')