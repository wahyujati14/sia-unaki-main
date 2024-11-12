@extends('admin.layouts.master',['title'=>'Login Admin'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Ujian',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Ujian', 
            'slug' => 'students'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('exam_questions.update', $exam_question->id)}}" method="POST" enctype="multipart/form-data">
                <div class="card-header">
                <h4>Pertanyaan</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>Soal</label>
                      <select name="exam_id" id="" class="form-control" required>
                        <option value="">PILIH</option>
                        @foreach ($exams as $exam)
                        <option value="{{$exam->id}}" {{($exam->id == $exam_question->exam_id)?'selected': ''}}>{{$exam->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Pertanyaan</label>
                      <input type="text" class="form-control" name="question" value="{{$exam_question->question}}" required>
                    </div>
                    <div class="form-group">
                      <label>Gambar</label>
                      <br>
                      <img src="{{asset('storage/'.$exam_question->image)}}" alt="" class="img-thumbnail" width="100px">
                      <input type="file" class="form-control" name="image">
                    </div>
                    <div class="section-title">Jawaban</div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadioA" name="is_correct" value="{{$exam_question->exam_answers[0]->id}}" class="custom-control-input" {{($exam_question->exam_answers[0]->is_correct)?'checked':''}}>
                      <label class="custom-control-label" for="customRadioA">Masukan Jawaban</label>
                      <input type="text" class="form-control" name="answer[{{$exam_question->exam_answers[0]->id}}]" placeholder="Input Jawaban" required value="{{$exam_question->exam_answers[0]->answer}}">
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadioB" name="is_correct" value="{{$exam_question->exam_answers[1]->id}}" class="custom-control-input" {{($exam_question->exam_answers[1]->is_correct)?'checked':''}}>
                      <label class="custom-control-label" for="customRadioB">Masukan Jawaban</label>
                      <input type="text" class="form-control" name="answer[{{$exam_question->exam_answers[1]->id}}]" placeholder="Input Jawaban" required value="{{$exam_question->exam_answers[1]->answer}}">
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadioC" name="is_correct" value="{{$exam_question->exam_answers[2]->id}}" class="custom-control-input" {{($exam_question->exam_answers[2]->is_correct)?'checked':''}}>
                      <label class="custom-control-label" for="customRadioC">Masukan Jawaban</label>
                      <input type="text" class="form-control" name="answer[{{$exam_question->exam_answers[2]->id}}]" placeholder="Input Jawaban" required value="{{$exam_question->exam_answers[2]->answer}}">
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadioD" name="is_correct" value="{{$exam_question->exam_answers[3]->id}}" class="custom-control-input" {{($exam_question->exam_answers[3]->is_correct)?'checked':''}}>
                      <label class="custom-control-label" for="customRadioD">Masukan Jawaban</label>
                      <input type="text" class="form-control" name="answer[{{$exam_question->exam_answers[3]->id}}]" placeholder="Input Jawaban" required value="{{$exam_question->exam_answers[3]->answer}}">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Update</button>
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