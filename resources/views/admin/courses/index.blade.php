@extends('admin.layouts.master',['title'=>'Mata Kuliah'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Mata Kuliah',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Mata Kuliah', 
            'slug' => 'courses'
        ]
      ]
    ])
    <div class="section-body">
      <form method="GET" action="{{ route('courses.index') }}">
        <div class="card">
          <div class="card-header">
            <h4>Search Form</h4>
          </div>
          <div class="card-body">
            <div class="form-group row m-1">
              <div class="col-sm-6">
                <input type="text" class="form-control m-1" name="search" placeholder="Cari" value="{{ request()->get('search') }}">
              </div>
              <div class="col-sm-6">
                <x-admins.inputs.study-program />
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
              <a href="{{route('courses.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Program Studi</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($courses as $course)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$course->study_program->name}}</td>
                        <td>{{$course->code}}</td>
                        <td>{{$course->name}}</td>
                        <td class="row m-auto">
                            <a href="{{route('courses.edit', $course->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('courses.destroy', $course->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </table>
                {{ $courses->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection