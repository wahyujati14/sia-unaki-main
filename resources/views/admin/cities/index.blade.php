@extends('admin.layouts.master',['title'=>'Kota'])
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
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('cities.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Provinsi</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($cities as $city)
                    <tr>
                        <td>{{$loop->iteration + $cities->firstItem() - 1}}</td>
                        <td>{{$city->name}}</td>
                        <td>{{$city->provincy_name}}</td>
                        <td class="row m-auto">
                          <a href="{{route('cities.edit', $city->id)}}" class="badge badge-primary">Edit</a>
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
            @include('admin.layouts.paginate', ['paginators' => $cities])
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

