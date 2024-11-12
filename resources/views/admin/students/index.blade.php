@extends('admin.layouts.master',['title'=>'Login Admin'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Mahasiswa',
        'breadcrumbs' =>
      [    
        [
            'name' => 'User Mahasiswa', 
            'slug' => 'students'
        ]
      ]
    ])
    <div class="section-body">

    <form method="GET" action="{{ route('students.index') }}">
      <div class="card">
        <div class="card-header">
          <h4>Search Form</h4>
        </div>
        <div class="card-body">
          <div class="form-group row m-1">
            <div class="col-sm-6">
              <input type="text" class="form-control m-1" name="name" placeholder="Name" value="{{@$data['name']}}">
            </div>
            <div class="col-sm-6">
              <input type="text" class="form-control m-1" name="email" placeholder="Email" value="{{@$data['email']}}">
            </div>
            <div class="col-sm-6">
              <input type="text" class="form-control m-1" name="phone" placeholder="Phone" value="{{@$data['phone']}}">
            </div>
            <div class="col-sm-6">
              <input type="date" class="form-control m-1" name="created_at" placeholder="Date" value="{{@$data['created_at']}}">
            </div>
            <div class="col-sm-12">
              <input type="text" class="form-control m-1" name="nim" placeholder="NIM" value="{{@$data['nim']}}">
            </div>
            <div class="col-12">
              <x-admins.inputs.study-program value="{{ @$data['study_program_id'] }}"/>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary float-right">Cari</button>
        </div>
      </div>
    </form>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4> Table</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Program Studi</th>
                    <th>Name</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Register At</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($users as $user)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->study_program_selected?->study_program?->name ?? '-'}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->nim}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{date('l, d-m-Y H:i:s', strtotime($user->created_at))}}</td>
                        <td>
                            <div class="m-1 badge badge-{{($user->email_verified_at)?'success':'secondary'}}">Verifikasi Email</div>
                            <div class="m-1 badge badge-{{($user->user_information)?'success':'secondary'}}">Kelengkapan Data</div>
                            <div class="m-1 badge badge-{{($user->school_origin)?'success':'secondary'}}">Sekolah Asal</div>
                            <div class="m-1 badge badge-{{($user->user_information?->registration_path_id)?'success':'secondary'}}">Pilih Jalur</div>
                            <div class="m-1 badge badge-{{(count($user->user_file_upload) > 0)?'success':'secondary'}}">Upload File</div>
                        </td>

                        <td class="row d-flex m-auto">
                          @if($user->lecturer == null) 
                          <a href="{{route('students.assign.lecturers.create', $user->id)}}" class="badge badge-primary d-inline">Assign Dosen</a>
                          @endif
                          <a href="{{route('students.show', $user->id)}}" class="badge badge-primary d-inline">Detail</a>
                          <form action="{{route('students.destroy', $user->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="badge badge-danger border-0 delete">Delete</button>
                          </form>
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
            @include('admin.layouts.paginate', ['paginators' => $users])
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
