@extends('admin.layouts.master',['title'=>'Jadwal Kelas'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Jadwal Kelas',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Jadwal Kelas', 
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
              <div class="col-12">
                <input type="text" class="form-control m-1" name="search" placeholder="Kode" value="{{ request()->get('code') }}">
              </div>
              <div class="col-12">
                <x-admins.inputs.class-course :value="request()->get('class_course_id')"/>
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
              <a href="{{route('schedule_class_courses.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Kelas</th>
                    <th>Kode Kelas</th>
                    <th>Hari</th>
                    <th>Ruangan</th>
                    <th>Kuota</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Durasi</th>
                  </tr>
                  @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $schedule->code }}</td>
                        <td>{{ $schedule->class_course->course->name }}</td>
                        <td>{{ $schedule->class_course->code }}</td>
                        <td>{{ $schedule->days()[$schedule->days] }}</td>
                        <td>{{ $schedule->room->name }}</td>
                        <td>{{ $schedule->quota }}</td>
                        <td>{{ $schedule->start_time }}</td>
                        <td>{{ $schedule->end_time }}</td>
                        <td class="row m-auto">
                            <a href="{{route('schedule_class_courses.edit', $schedule->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('schedule_class_courses.destroy', $schedule->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger border-0 delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </table>
                {{ $schedules->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection