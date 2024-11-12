@extends('admin.layouts.master',['title'=>'Kelurahan'])
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
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('sub_districts.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Kecamatan</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($sub_districts as $sub_district)
                    <tr>
                        <td>{{$loop->iteration + $sub_districts->firstItem() - 1}}</td>
                        <td>{{$sub_district->name}}</td>
                        <td>{{$sub_district->district_name}}</td>
                        <td class="row m-auto">
                          <a href="{{route('sub_districts.edit', $sub_district->id)}}" class="badge badge-primary">Edit</a>
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
            @include('admin.layouts.paginate', ['paginators' => $sub_districts])
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

