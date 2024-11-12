@extends('admin.layouts.master',['title'=>'Tambah Grup Kelas'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Grup Kelas',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Grup Kelas', 
            'slug' => 'class_courses'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('class_courses.store')}}" method="POST">
                <div class="card-header">
                <h4>Grup Kelas</h4>
                </div>
                <div class="card-body row">
                    @csrf
                    <div class="form-group col-12 col-lg-6">
                        <label>Mata Kuliah</label>
                        <x-admins.inputs.course />
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Dosen</label>
                        <x-admins.inputs.lecturer />
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Semester</label>
                        <input type="text" name="semester" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Kode</label>
                        <input type="text" name="code" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>SKS</label>
                        <input type="number" name="credit_course" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>SKS Jam</label>
                        <input type="number" name="credit_course_hourly" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>SKS Pembayaran</label>
                        <input type="number" name="credit_course_payment" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Bobot Hadir</label>
                        <input type="number" name="presence_weight" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Bobot Quis</label>
                        <input type="number" name="quiz_weight" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Bobot Tugas</label>
                        <input type="number" name="task_weight" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Bobot TTS</label>
                        <input type="number" name="tts_weight" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Bobot TAS</label>
                        <input type="number" name="tas_weight" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Total Bobot</label>
                        <input type="number" name="total_weight" disabled class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Nilai Rata - Rata</label>
                        <input type="number" name="avg_score" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Std. Deviasi</label>
                        <input type="number" name="deviation" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Nilai Valid</label>
                        <input type="number" name="valid_score" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Catatan</label>
                        <textarea name="note" id="" class="form-control" rows="3"></textarea>
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