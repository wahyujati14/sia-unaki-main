@extends('admin.layouts.master',['title'=>'Kelompok Kelas'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Kelompok Kelas',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Grup Kelas', 
            'slug' => 'class_courses'
        ]
      ]
    ])
    <div class="section-body">
      <form method="GET" action="{{ route('class_courses.index') }}">
        <div class="card">
          <div class="card-header">
            <h4>Search Form</h4>
          </div>
          <div class="card-body">
            <div class="form-group row m-1">
              <div class="col-sm-6">
                <input type="text" class="form-control m-1" name="code" placeholder="Kode" value="{{ request()->get('code') }}">
              </div>
              <div class="col-sm-6">
                <x-admins.inputs.academic-year />
              </div>
              <div class="col-sm-6">
                <x-admins.inputs.course />
              </div>
              <div class="col-sm-6">
                <x-admins.inputs.lecturer />
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
              <h4>Tabel Kelompok Kelas</h4>
              <div class="card-header-action">
                <a href="{{route('class_courses.create')}}" class="btn btn-success flaot-left">Tambah</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Matkul</th>
                    <th>Dosen</th>
                    <th>Kode</th>
                    <th>Semester</th>
                    <th>SKS</th>
                    <th>SKS Jam</th>
                    <th>SKS Pembayaran</th>
                    <th>Catatan</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($class_courses as $course)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $course->course->name}}</td>
                        <td>{{ $course->lecturer->name}}</td>
                        <td>{{ $course->code}}</td>
                        <td>{{ $course->semester }}</td>
                        <td>{{ $course->credit_course}}</td>
                        <td>{{ $course->credit_course_hourly}}</td>
                        <td>{{ $course->credit_course_payment}}</td>
                        <td>{{ $course->note }}</td>
                        <td class="row m-auto">
                            <a href="{{route('class_courses.edit', $course->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('class_courses.destroy', $course->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger border-0 delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </table>
                {{ $class_courses->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection