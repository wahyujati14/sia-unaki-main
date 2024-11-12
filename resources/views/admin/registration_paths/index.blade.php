@extends('admin.layouts.master',['title'=>'Jalur Registrasi'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Jalur Registrasi',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Jalur Registrasi', 
            'slug' => 'registration_paths'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('registration_paths.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($registration_paths as $registration_path)
                    <tr>
                        <td>{{$loop->iteration }}</td>
                        <td>{{$registration_path->name}}</td>
                        <td>{{$registration_path->description}}</td>
                        <td>{{$registration_path->slug}}</td>
                        <td>{{$registration_path->code}}</td>
                        <td class="row m-auto">
                            <a class="text-white btn btn-{{($registration_path->is_active)?'success':'danger'}}">{{($registration_path->is_active)?'Aktif':'Tidak Aktif'}}</a>
                        </td>
                        <td>
                          <a href="{{route('registration_paths.edit', $registration_path->id)}}" class="badge badge-primary">Edit</a>
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