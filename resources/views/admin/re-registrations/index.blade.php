@extends('admin.layouts.master',['title'=>'Daftar Ulang'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Daftar Ulang',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Daftar Ulang', 
            'slug' => 're_registrations'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Nominal</th>
                    <th>Tipe Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Status Validasi</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($re_registrations as $re_registration)
                    <tr>
                        <td>{{$loop->iteration }}</td>
                        <td>{{$re_registration->user->name}}</td>
                        <td>@rupiah($re_registration->user_payment->nominal)</td>
                        <td>{{$re_registration->user_payment->payment_type->name}}</td>
                        <td>{{$re_registration->user_payment->status}}</td>
                        <td class="row m-auto">
                            @if ($re_registration->status == 'PROSES')
                                <form action="{{route('re_registrations.update', $re_registration->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="true" name="is_approve">
                                    <input type="hidden" value="PAID" name="status">
                                    <button type="submit" class="badge bg-success approve text-white" style="border:none;">Approve</button>
                                </form>
                                <form action="{{route('re_registrations.update', $re_registration->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="false" name="is_approve">
                                    <input type="hidden" value="FAILED" name="status">
                                    <button type="submit" class="badge bg-danger decline text-white" style="border:none;">Decline</button>
                                </form>
                            @else
                              <a class="text-white badge bg-{{($re_registration->is_approve)?'success':'danger'}}">{{($re_registration->is_approve)?'Diterima':'Ditolak'}}</a>
                            @endif
                        </td>
                        <td>
                            @if ($re_registration->is_approve || $re_registration->status = 'VALID' || $re_registration->status = 'FAILED')
                              <a href="{{route('re_registrations.show', $re_registration->id)}}" class="badge badge-primary">Detail</a>
                            @endif
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection