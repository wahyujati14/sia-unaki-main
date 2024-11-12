@extends('admin.layouts.master',['title'=>'Tipe Pembayaran'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Tipe Pembayaran',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Tipe Pembayaran', 
            'slug' => 'payment_types'
        ]
      ]
    ])
    <div class="section-body">
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
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($payment_types as $payment_type)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$payment_type->name}}</td>
                        <td>
                          <a class="text-white btn btn-{{($payment_type->is_active)?'success':'danger'}}">{{($payment_type->is_active)?'Aktif':'Tidak Aktif'}}</a></td>
                        <td class="row m-auto">
                          <a href="{{route('payment_types.edit', $payment_type->id)}}" class="badge badge-primary">Edit</a>
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

