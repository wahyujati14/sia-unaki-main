@extends('admin.layouts.master',['title'=>'Login Admin'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
      'title' => 'Pembayaran',
      'breadcrumbs' =>
    [    
      [
          'name' => 'Pembayaran', 
          'slug' => 'user_payments'
      ]
    ]
  ])
  <div class="section-body">
  <form method="GET" action="{{ route('user_payments.index') }}">
    <div class="card">
      <div class="card-header">
        <h4>Search Form</h4>
      </div>
      <div class="card-body">
        <div class="form-group row m-1">
          <div class="col-sm-6">
            <input type="text" class="form-control m-1" name="name" placeholder="Name" value="{{@$data['name']}}">
          </div>
          <div class="col-sm-6">
            <select name="status" id="" class="form-control m-1">
                <option value="">Status</option>
                <option value="PAID" {{(@$data['status'] == 'PAID')?'selected':''}}>PAID</option>
                <option value="PENDING" {{(@$data['status'] == 'PENDING')?'selected':''}}>PENDING</option>
                <option value="FAILED" {{(@$data['status'] == 'FAILED')?'selected':''}}>FAILED</option>
                <option value="EXPIRED" {{(@$data['status'] == 'EXPIRED')?'selected':''}}>EXPIRED</option>
            </select>
          </div>
          <div class="col-sm-4">
            <select name="type" id="" class="form-control m-1">
                <option value="">Pembayaran Untuk</option>
                @foreach ($data['types'] as $type)
                  <option value="{{$type}}" {{(@$data['type'] == $type)?'selected':''}}>{{$type}}</option>
                @endforeach
            </select>
          </div>
          <div class="col-sm-4">
            <select name="payment_type_id" id="" class="form-control m-1">
                <option value="">Tipe Pembayaran</option>
                @foreach ($data['payment_types'] as $payment_type)
                  <option value="{{$payment_type->id}}" {{(@$data['payment_type_id'] == $payment_type->id)?'selected':''}}>{{$payment_type->name}}</option>
                @endforeach
            </select>
          </div>
          <div class="col-sm-4">
            <select name="is_validate" id="" class="form-control m-1">{{@$data['is_validate']}}
                  <option value="">Tipe Pembayaran</option>
                  <option value="true" {{(@$data['is_validate'] == true)?'selected':''}}>Tervalidasi</option>
                  <option value="false" {{(@$data['is_validate'] == false)?'selected':''}}>Belum Tervalidasi</option>
            </select>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary float-right">Cari</button>
      </div>
    </div>
  </form>

    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4> Table</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Pembayaran Untuk</th>
                  <th>Status</th>
                  <th>Tipe Pembayaran</th>
                  <th>Validasi Admin</th>
                  <th>Action</th>
                </tr>
                @foreach ($user_payments as $user_payment)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$user_payment->user->name}}</td>
                      <td>{{$user_payment->type}}</td>
                      <td>{{$user_payment->status}}</td>
                      <td>{{$user_payment->payment_type->name}}</td>
                      <td>{{($user_payment->is_validate == false)?'Belum Tervalidasi':'Tervalidasi'}}</td>
                      <td class="row m-auto">
                        @if (!$user_payment->is_validate)
                          <form action="{{route('user_payments.update', $user_payment->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="true" name="is_validate">
                            <input type="hidden" value="PAID" name="status">
                            <button type="submit" class="btn btn-success approve">Approve</button>
                        </form>
                            @if ($user_payment->status == 'PENDING' || $user_payment->status == 'PAID')
                                <form action="{{route('user_payments.update', $user_payment->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="false" name="is_validate">
                                    <input type="hidden" value="FAILED" name="status">
                                    <button type="submit" class="badge badge-danger decline">Decline</button>
                                </form>
                            @endif
                        @endif
                        {{-- <a href="{{route('user_payments.show', $user_payment->id)}}" class="btn btn-primary">Detail Jawaban</a> --}}
                      </td>
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
          @include('admin.layouts.paginate', ['paginators' => $user_payments])
        </div>
      </div>
    </div>
  </div>
</section>
@endsection