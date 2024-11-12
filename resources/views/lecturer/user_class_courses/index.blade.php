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
              <div class="col-12">
                <x-admins.inputs.course :value="request()->get('course_id')"/>
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
                        <td>
                          @if($course->status == 'WAITING')
                          <a href="" class="badge badge-warning">{{ $course->status_text }}</a>
                          @elseif($course->status == 'APPROVED')
                          <a href="" class="badge badge-success">{{ $course->status_text }}</a>
                          @elseif($course->status == 'DECLINED')
                          <a href="" class="badge badge-danger border-0">{{ $course->status_text }}</a>
                          @else
                          <a href="" class="badge badge-primary">Tidak Ada Status</a>
                          @endif
                        </td>
                        <td>
                            <a href="{{route('lecturer.user_class_courses.edit', $course->id)}}" class="badge badge-primary">Edit</a>
                            @if($course->status == 'WAITING')
                            <form action="{{route('lecturer.user_class_courses.approve', $course->id)}}" method="post">
                                @csrf
                                <a class="badge badge-success approve text-white" type="submit">Terima</a>
                            </form>
                            <form action="{{route('lecturer.user_class_courses.decline', $course->id)}}" method="post">
                                @csrf
                                <a class="badge badge-danger border-0 approve text-white" type="submit">Tolak</a>
                            </form>
                            @endif
                            <form action="{{route('lecturer.user_class_courses.destroy', $course->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a class="badge badge-danger border-0 delete text-white" type="submit">Delete</a>
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