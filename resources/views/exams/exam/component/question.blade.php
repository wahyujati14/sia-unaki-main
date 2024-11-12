<div class="col-sm-12 card-pertanyaan">
    @php
        $question = $exam->getQuestionRandom($exam->id);
    @endphp
    <h5 class="text-primary" style="font-weight: 600;font-family: 'Lato',sans-serif !important;">Pertanyaan {{@$question->user_answer?->count()??0 + 1}}</h5>
    <p class="pertanyaan">{{@$question->question}}</p>
    <input type="hidden" value="{{@$question->id}}" name="question_id">
    <input type="hidden" value="{{$exam->id}}" name="exam_id">
    @foreach(@$question->exam_answers??[] as $key => $value)
        <div class="row">
            <div class="col-auto m-0 p-0">
                <label class="btn">
                    {{to_alphabetic($key)}}
                </label>
                <input type="radio" name="answer_id" id="" value="{{$value->id}}" required>
            </div>
            <div class="col mt-2">
                <p class="text-dark2">{{$value->answer}}</p>
            </div>
        </div>
    @endforeach
</div>
