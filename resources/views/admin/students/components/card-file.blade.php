<div class="card profile-widget">
    <div class="card-header">
      <h4>Informasi File</h4>
    </div>
    <div class="card-body">
      <div class="profile-widget-header">
        <div class="profile-widget-items">
          @if (count($student->user_file_upload) <= 0)
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Tidak ada File</div>
            <div class="profile-widget-item-value"> Tidak ada File </div>
          </div>
          @else
          @foreach ($student->user_file_upload->whereIn('file_upload_id', [1, 2, 3, 5, 6]) as $key => $file)
            <div class="profile-widget-item">
              <div class="profile-widget-item-label">{{$file->file_type}}</div>
              <div class="profile-widget-item-value"> <a href="{{asset('storage/'.$file->file)}}" target="_blank">Lihat</a></div>
              <div class="profile-widget-item-value"> <a href="{{asset('storage/'.$file->file)}}" download="{{$file->file_name}}">Download</a></div>
            </div>
          @endforeach
          @endif
          @php
            $user_payment = $student->user_payments->where('payment_type_id', \App\Models\PaymentType::XENDIT)->where('type', \App\Models\UserPayment::TYPE_REGISTRATION)->first();
          @endphp
        </div>
      </div>
      <div class="profile-widget-description pb-0">
        <div class="profile-widget-name">Jurusan yang di pilih</div>
        <p class="btn btn-{{($student->user_study_program->where('type', 'FIRST')->first()?->is_confirmed)?'primary':'secondary'}}">{{@$student->study_program_first()}}</p>
        <p class="btn btn-{{($student->user_study_program->where('type', 'SECOND')->first()?->is_confirmed)?'primary':'secondary'}}">{{@$student->study_program_second()}}</p>
      </div>
    </div>
  </div>
<div class="card profile-widget">
    <div class="card-header">
      <h4>Informasi Pembayaran</h4>
    </div>
    <div class="card-body">
      <div class="profile-widget-header">
        <div class="profile-widget-items">
          @if (count($student->user_file_upload) <= 0)
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Tidak ada File</div>
            <div class="profile-widget-item-value"> Tidak ada File </div>
          </div>
          @else
          @foreach ($student->user_file_upload->whereIn('file_upload_id', [4, 7]) as $key => $file)
            <div class="profile-widget-item">
              <div class="profile-widget-item-label">{{$file->file_type}}</div>
              <div class="profile-widget-item-value"> <a href="{{asset('storage/'.$file->file)}}" target="_blank">Lihat</a></div>
              <div class="profile-widget-item-value"> <a href="{{asset('storage/'.$file->file)}}" download="{{$file->file_name}}">Download</a></div>
              @if ($student->is_complate_data())
              <form  method="POST" action="{{ route('user_file_uploads.update', $file->id) }}">
                @csrf
                @method('PUT')
                  @if ($file->file_verification)
                  <input type="hidden" name="file_verification" value="false">
                  <button class="btn btn-success btn-icon icon-right btn-submit decline" >Verifikasi</button>
                  @else
                  <input type="hidden" name="file_verification" value="true">
                  <button class="btn btn-secondary btn-icon icon-right btn-submit approve">Belum Verifikasi</button>
                  @endif
              </form>
              @endif
            </div>
          @endforeach
          @endif
          @php
            $user_payment = $student->user_payments->where('payment_type_id', \App\Models\PaymentType::XENDIT)->where('type', \App\Models\UserPayment::TYPE_REGISTRATION)->first();
          @endphp
          @if ($user_payment)
            <div class="profile-widget-item">
              <div class="profile-widget-item-label">scan_bukti_pembayaran (Registrasi) <br> Handle With Xendit</div>
              <div class="profile-widget-item-value">{{$user_payment->status}} Payment</div>
            </div>
          @endif
          @php
            $user_payment = $student->user_payments->where('payment_type_id', \App\Models\PaymentType::XENDIT)->where('type', \App\Models\UserPayment::TYPE_REREGISTRATION)->first();
          @endphp
          @if ($user_payment)
            <div class="profile-widget-item">
              <div class="profile-widget-item-label">upload-pembayaran-daftar-ulang <br> Handle With Xendit</div>
              <div class="profile-widget-item-value">{{$user_payment->status}} Payment</div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>