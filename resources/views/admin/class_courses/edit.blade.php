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
            <form action="{{route('class_courses.update', $class_course->id)}}" method="POST">
                <div class="card-header">
                <h4>Grup Kelas</h4>
                </div>
                <div class="card-body row">
                    @csrf
                    @method('put')
                    <div class="form-group col-12 col-lg-6">
                        <label>Mata Kuliah</label>
                        <x-admins.inputs.course required :value="$class_course->course_id"/>
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Dosen</label>
                        <x-admins.inputs.lecturer required :value="$class_course->lecturer_id" />
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Semester</label>
                        <input type="text" name="semester" value="{{ $class_course->semester }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Kode</label>
                        <input type="text" name="code" value="{{ $class_course->code }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>SKS</label>
                        <input type="number" name="credit_course" value="{{ $class_course->credit_course }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>SKS Jam</label>
                        <input type="number" name="credit_course_hourly" value="{{ $class_course->credit_course_hourly }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>SKS Pembayaran</label>
                        <input type="number" name="credit_course_payment" value="{{ $class_course->credit_course_payment }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Bobot Hadir</label>
                        <input type="number" name="presence_weight" input-weight value="{{ $class_course->presence_weight ?? 0 }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Bobot Quis</label>
                        <input type="number" name="quiz_weight" input-weight value="{{ $class_course->quiz_weight ?? 0 }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Bobot Tugas</label>
                        <input type="number" name="task_weight" input-weight value="{{ $class_course->task_weight ?? 0 }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Bobot TTS</label>
                        <input type="number" name="tts_weight" input-weight value="{{ $class_course->tts_weight ?? 0 }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Bobot TAS</label>
                        <input type="number" name="tas_weight" input-weight value="{{ $class_course->tas_weight ?? 0 }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Total Bobot</label>
                        <input type="number" name="total_weight" value="{{ $class_course->total_weight }}" disabled class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Nilai Rata - Rata</label>
                        <input type="number" name="avg_score" value="{{ $class_course->avg_score ?? 0 }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Std. Deviasi</label>
                        <input type="number" name="deviation" value="{{ $class_course->deviation ?? 0 }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Nilai Valid</label>
                        <input type="number" name="valid_score" value="{{ $class_course->valid_score ?? 0 }}" class="form-control" required id="">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label>Catatan</label>
                        <textarea name="note" id="" class="form-control" rows="3">{{ $class_course->note }}</textarea>
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

@push('js')
<script>
    $('[input-weight]').on('change', () => {
        let value = 0;

        $('[input-weight]').each((idx, elem) => {
            value += parseInt(elem.value)
        })

        $('[name=total_weight]').val(value)
    })
</script>
@endpush