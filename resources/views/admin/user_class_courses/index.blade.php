@extends('admin.layouts.master',['title'=>'Kelas Mahasiswa'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Kelas Mahasiswa',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Kelas Mahasiswa', 
            'slug' => 'user_class_courses'
        ]
      ]
    ])
    <div class="section-body">
      <form method="GET" action="{{ route('user_class_courses.index') }}">
        <div class="card">
          <div class="card-header">
            <h4>Search Form</h4>
          </div>
          <div class="card-body">
            <div class="form-group row m-1">
              <div class="col-sm-6">
                <x-admins.inputs.course :value="request()->get('course_id')"/>
              </div>
              <div class="col-sm-6">
                <x-admins.inputs.lecturer :value="request()->get('lecturer_id')"/>
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
              <a href="{{route('user_class_courses.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Program Studi</th>
                    <th>Dosen</th>
                    <th>Tahun</th>
                    <th>Mahasiswa</th>
                    <th>SKS</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($courses as $course)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        
                        <td>{{ $course->course->name }}</td>
                        <td>{{ $course->lecturer->name }}</td>
                        <td>{{ $course->study_plan_card->academic_year->toDescriptionString() }}</td>
                        <td>{{ $course->study_plan_card->user->nim }} - {{ $course->study_plan_card->user->name }}</td>
                        <td>{{ $course->credit_course }}</td>
                        <td>{{ $course->statuses()[$course->status] }}</td>
                        <td class="row m-auto">
                            <a href="{{route('user_class_courses.edit', $course->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('user_class_courses.destroy', $course->id)}}" method="post">
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