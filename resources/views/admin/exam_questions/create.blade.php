@extends('admin.layouts.master',['title'=>'Tambah Pertanyaan'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Tambah Pertanyaan',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Tambah Pertanyaan', 
            'slug' => 'students'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <form action="{{route('exam_questions.store')}}" method="POST" enctype="multipart/form-data">
                <div class="card-header">
                <h4>Pertanyaan</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                      <label>Soal</label>
                      <select name="exam_id" id="" class="form-control" required>
                        <option value="">PILIH</option>
                        @foreach ($exams as $exam)
                        <option value="{{$exam->id}}">{{$exam->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Pertanyaan</label>
                      <input type="text" class="form-control" name="question" required>
                    </div>
                    <div class="form-group">
                      <label>Gambar</label>
                      <input type="file" class="form-control" name="image">
                    </div>
                    <div class="section-title">Jawaban</div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadioA" name="is_correct" value="0" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioA">Masukan Jawaban</label>
                      <input type="text" class="form-control" name="answer[]" placeholder="Input Jawaban" required>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadioB" name="is_correct" value="1" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioB">Masukan Jawaban</label>
                      <input type="text" class="form-control" name="answer[]" placeholder="Input Jawaban" required>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadioC" name="is_correct" value="2" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioC">Masukan Jawaban</label>
                      <input type="text" class="form-control" name="answer[]" placeholder="Input Jawaban" required>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadioD" name="is_correct" value="3" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioD">Masukan Jawaban</label>
                      <input type="text" class="form-control" name="answer[]" placeholder="Input Jawaban" required>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Tambah</button>
                </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

@push('js')
@endpush