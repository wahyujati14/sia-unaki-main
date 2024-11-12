@extends('admin.layouts.master',['title'=>'Provinsi'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Provinsi',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Provinsi', 
            'slug' => 'provincies'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('provincies.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($provincies as $province)
                    <tr>
                        <td>{{$loop->iteration + $provincies->firstItem() - 1}}</td>
                        <td>{{$province->name}}</td>
                        <td class="row m-auto">
                          <a href="{{route('provincies.edit', $province->id)}}" class="badge badge-primary">Edit</a>
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
            @include('admin.layouts.paginate', ['paginators' => $provincies])
          </div>
        </div>
      </div>
    </div>
</section>
@endsection