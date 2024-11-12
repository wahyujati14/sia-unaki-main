@extends('admin.layouts.master',['title'=>'Edit Kota'])
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Kota',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Kota', 
            'slug' => 'cities'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('cities.update', $city->id)}}" method="POST">
                <div class="card-header">
                <h4>Kota</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" value="{{$city->name}}" required>
                    </div>
                    <div class="form-group">
                      <label>Provinsi</label>
                      <select id="" class="form-control select2" name="provincy_id" required>
                        <option value="">PILIH</option>
                        @foreach ($provincies as $province)
                            <option value="{{$province->id}}" {{($province->id == $city->provincy_id)?'selected':''}}>{{$province->name}}</option>
                        @endforeach
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush