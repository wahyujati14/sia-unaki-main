@extends('admin.layouts.master',['title'=>'Kecamatan'])
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
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('districts.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Kota</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($districts as $district)
                    <tr>
                        <td>{{$loop->iteration + $districts->firstItem() - 1}}</td>
                        <td>{{$district->name}}</td>
                        <td>{{$district->city_name}}</td>
                        <td class="row m-auto">
                          <a href="{{route('districts.edit', $district->id)}}" class="badge badge-primary">Edit</a>
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
            @include('admin.layouts.paginate', ['paginators' => $districts])
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

