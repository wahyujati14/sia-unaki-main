@extends('admin.layouts.master',['title'=>'Edit Admin'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Admin',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Admin', 
            'slug' => 'cities'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('admins.update', $admin->id)}}" method="POST" enctype="multipart/form-data">
                <div class="card-header">
                <h4>Admin</h4>
                </div>
                <div class="card-body">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" required value="{{$admin->name}}">
                    </div>
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" required value="{{$admin->username}}">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                      <label>Konfirmasi Password</label>
                      <input type="password" class="form-control" name="confirmation_password">
                    </div>
                    <div class="form-group">
                      <label>Avatar</label>
                      <img src="{{asset('storage/'.$admin->avatar)}}" alt="" style="width: 30%">
                      <input type="file" class="form-control" name="avatar">
                    </div>
                    <div class="form-group">
                      <label>Role</label>
                      <select name="role_id" class="form-control" id="" required>
                        <option value="">PILIH</option>
                        @foreach ($roles as $role)
                          <option value="{{$role->id}}"{{($admin->role_id == $role->id)?'selected':''}}>{{$role->name}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
