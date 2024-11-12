@extends('admin.layouts.master',['title'=>'Informasi Admin'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Informasi',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Informasi', 
            'slug' => 'information_services'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        @if (Request::routeIs('information_services.*'))
          <div class="col-6 col-md-6 col-lg-6">
            <div class="card">
              <form action="{{route('information_services.update', $information_service->id)}}" method="POST">
                  <div class="card-header">
                  <h4>Informasi</h4>
                  </div>
                  <div class="card-body">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{$information_service->email}}">
                      </div>
                      <div class="form-group">
                        <label>Whatsapp</label>
                        <input type="text" class="form-control" name="whatsapp" value="{{$information_service->whatsapp}}">
                      </div>
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$information_service->phone}}">
                      </div>
                      <div class="form-group">
                        <label>No Rekening (Untuk Pembayaran Uplaod Bukti)</label>
                        <input type="text" class="form-control" name="account_number" value="{{$information_service->account_number}}">
                      </div>
                  </div>
                  <div class="card-footer text-right">
                      <button class="btn btn-primary mr-1" type="submit">Update</button>
                  </div>
              </form>
            </div>
          </div>
        @endif
        @if (Request::routeIs('information_service_payments.*'))
          <div class="col-6 col-md-6 col-lg-6">
            <div class="card">
              <form action="{{route('information_services.update', $information_service->id)}}" method="POST">
                  <div class="card-header">
                  <h4>Informasi Pembayaran</h4>
                  </div>
                  <div class="card-body">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                        <label>Nominal Pembayaran Pendaftaran</label>
                        <input type="text" class="form-control" name="payment_registrations" value="{{$information_service->payment_registrations}}">
                      </div>
                      <div class="form-group">
                        <label>Sumbangan Pengembangan Institusi Reguler </label>
                        <input type="text" class="form-control" name="institute_development_contribution" value="{{$information_service->institute_development_contribution}}">
                      </div>
                      <div class="form-group">
                        <label>Sumbangan Pengembangan Institusi Karyawan</label>
                        <input type="text" class="form-control" name="institute_development_contribution_reguler" value="{{$information_service->institute_development_contribution_reguler}}">
                      </div>
                      <div class="form-group">
                        <label>Sumbangan Pembinaan Pendidikan </label>
                        <input type="text" class="form-control" name="education_construction_contribution" value="{{$information_service->education_construction_contribution}}">
                      </div>
                      <div class="form-group">
                        <label>SKS</label>
                        <input type="text" class="form-control" name="sks" value="{{$information_service->sks}}">
                      </div>
                      <div class="form-group">
                        <label>Pembayaran Uang Pangkal </label>
                        <input type="text" class="form-control" name="initial_payment" value="{{$information_service->initial_payment}}">
                      </div>
                      <div class="form-group">
                        <label>Iuran Kemahasiswaan</label>
                        <input type="text" class="form-control" name="kemahasiswaan_contribution" value="{{$information_service->kemahasiswaan_contribution}}">
                      </div>
                      <div class="form-group">
                        <label>Iuran Perpustakaan</label>
                        <input type="text" class="form-control" name="library_contribution" value="{{$information_service->library_contribution}}">
                      </div>
                      <div class="form-group">
                        <label>Iuran Kesehatan</label>
                        <input type="text" class="form-control" name="health_payment" value="{{$information_service->health_payment}}">
                      </div>
                      <div class="form-group">
                        <label>Discount (Potongan)</label>
                        <input type="text" class="form-control" name="discount" value="{{$information_service->discount}}">
                      </div>
                  </div>
                  <div class="card-footer text-right">
                      <button class="btn btn-primary mr-1" type="submit">Update</button>
                  </div>
              </form>
            </div>
          </div>
        @endif
      </div>
    </div>
</section>
@endsection

@push('js')
@endpush