@extends('admin.layouts.master',['title'=>'Role'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Role',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Role', 
            'slug' => 'roles'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('roles.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($roles as $role)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$role->name}}</td>
                        <td class="row m-auto">
                            <a href="{{route('roles.edit', $role->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('roles.destroy', $role->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger delete" type="submit">Delete</button>
                            </form>
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