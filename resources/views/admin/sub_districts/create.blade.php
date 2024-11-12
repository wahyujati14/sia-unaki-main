@extends('admin.layouts.master',['title'=>'Tambah Kelurahan'])
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Kelurahan',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Kelurahan', 
            'slug' => 'sub_districts'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('sub_districts.store')}}" method="POST">
                <div class="card-header">
                <h4>Kelurahan</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                      <label>Kecamatan</label>
                      <select id="" class="form-control select2" name="district_id" required>
                        <option value="">PILIH</option>
                        @foreach ($districts as $district)
                            <option value="{{$district->id}}">{{$district->name}}</option>
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