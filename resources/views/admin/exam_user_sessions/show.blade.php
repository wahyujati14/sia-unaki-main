@extends('admin.layouts.master',['title'=>'Jawaban'])
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
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Tabel Jawaban User</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Jawaban</th>
                  </tr>
                  @foreach ($exam->questions as $question)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$question->question}}</td>
                        <td>
                          @foreach ($question?->exam_answers as $answer)
                            <li>
                              @if ($answer->is_correct)
                                <i class="fas fa-check"></i>
                              @endif
                              {{$answer->answer}}
                            </li>
                          @endforeach
                        </td>
                        <td>{{$user_exam->exam_user_answers()->where('exam_question_id', 10)->first()->exam_answer->answer}}</td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

@push('js')
@endpush