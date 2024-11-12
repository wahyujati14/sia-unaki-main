@extends('admin.layouts.master',['title'=>'Login Admin'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Edit',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Edit', 
            'slug' => 'students'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-6 col-md-6 col-lg-6">
          <div class="card">
            <form action="{{route('certificate_receives.update', $certificate_receive->id)}}" method="POST">
                <div class="card-header">
                <h4>Informasi Pembayaran</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>Pembayaran Uang Pangkal </label>
                      <input type="text" class="form-control" name="initial_payment" value="@rupiah($certificate_receive->user_initial_payment->nominal)" disabled>
                    </div>
                    <div class="form-group">
                      <label>Iuran Kemahasiswaan</label>
                      <input type="text" class="form-control" name="kemahasiswaan_contribution" value="@rupiah($certificate_receive->kemahasiswaan_contribution->nominal)" disabled>
                    </div>
                    <div class="form-group">
                      <label>Iuran Perpustakaan</label>
                      <input type="text" class="form-control" name="library_contribution" value="@rupiah($certificate_receive->library_contribution->nominal)" disabled>
                    </div>
                    <div class="form-group">
                      <label>Iuran Kesehatan</label>
                      <input type="text" class="form-control" name="health_payment" value="@rupiah($certificate_receive->health_payment->nominal)" disabled>
                    </div>
                    {{-- <div class="form-group">
                      <label>Discount (Potongan)</label>
                      <input type="number" class="form-control" name="discount" value="{{$certificate_receive->discount->nominal??0}}">
                    </div> --}}
                    <label for=""><h1>@rupiah(\App\Models\InformationService::re_registration_price())</h1></label>
                </div>
                {{-- <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Update</button>
                </div> --}}
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

@push('js')
@endpush