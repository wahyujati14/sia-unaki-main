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
            <form action="{{route('schedule_class_courses.store')}}" method="POST">
                <div class="card-header">
                <h4>Jadwal Kelas</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label>Kelas</label>
                        <x-admins.inputs.class-course required/>
                    </div>
                    <div class="form-group">
                      <label for="">Kode</label>
                      <input type="text" name="code" class="form-control" required id="">
                    </div>
                    <div class="form-group">
                        <label>Hari</label>
                        <select name="days" id="" required class="form-control">
                            <option value="">PILIH</option>
                            @foreach ($days as $index => $day)
                              <option value="{{ $index }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="">Ruangan</label>
                      <x-admins.inputs.room />
                    </div>
                    <div class="form-group">
                      <label for="">Kuota</label>
                      <input type="number" name="quota" class="form-control" required id="">
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" name="start_time" class="form-control" required id="">
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai</label>
                        <input type="time" name="end_time" class="form-control" required id="">
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