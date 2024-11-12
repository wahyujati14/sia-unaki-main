@extends('admin.layouts.master',['title'=>'Edit Tipe Pembayaran'])
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
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('payment_types.update', $payment_type->id)}}" method="POST">
                <div class="card-header">
                <h4>Tipe Pembayaran</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" value="{{$payment_type->name}}">
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select name="is_active" id="" class="form-control">
                        <option value="true" {{($payment_type->is_active == true)?'selected':''}}>Aktif</option>
                        <option value="false" {{($payment_type->is_active == false)?'selected':''}}>Tidak Aktif</option>
                      </select>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Update</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

@push('js')
@endpush