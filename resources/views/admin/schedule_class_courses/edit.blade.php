@extends('admin.layouts.master',['title'=>'Tambah Jadwal Kelas'])
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
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('schedule_class_courses.update', $schedule->id)}}" method="POST">
                <div class="card-header">
                <h4>Jadwal Kelas</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Kelas</label>
                        <x-admins.inputs.class-course required value="{{ $schedule->class_course_id }}"/>
                    </div>
                    <div class="form-group">
                      <label for="">Kode</label>
                      <input type="text" name="code" class="form-control" required id="" value="{{ $schedule->code }}">
                    </div>
                    <div class="form-group">
                        <label>Hari</label>
                        <select name="days" id="" required class="form-control">
                            <option value="">PILIH</option>
                            @foreach ($days as $index => $day)
                              <option value="{{ $index }}" @selected($schedule->days == $index)>{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="">Ruangan</label>
                      <x-admins.inputs.room :value="$schedule->room_id"/>
                    </div>
                    <div class="form-group">
                      <label for="">Kuota</label>
                      <input type="number" name="quota" value="{{ $schedule->quota }}" class="form-control" required id="">
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" name="start_time" class="form-control" required id="" value="{{ $schedule->start_time }}">
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai</label>
                        <input type="time" name="end_time" class="form-control" required id="" value="{{ $schedule->end_time }}">
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