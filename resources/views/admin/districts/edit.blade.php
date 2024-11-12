@extends('admin.layouts.master',['title'=>'Edit Kecamatan'])
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Kecamatan',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Kecamatan', 
            'slug' => 'districts'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('districts.update', $district->id)}}" method="POST">
                <div class="card-header">
                <h4>Kecamatan</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" value="{{$district->name}}" required>
                    </div>
                    <div class="form-group">
                      <label>Kota</label>
                      <select id="" class="form-control select2" name="city_id" required>
                        <option value="">PILIH</option>
                        @foreach ($cities as $city)
                            <option value="{{$city->id}}" {{($city->id == $district->city_id)?'selected':''}}>{{$city->name}}</option>
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