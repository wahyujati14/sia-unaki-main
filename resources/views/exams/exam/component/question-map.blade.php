
    <div class="row">
        <div class="col-auto mt-4">
            <h5 class="text-dark mb-2" style="font-weight:700">Pilih Soal</h5>
        </div>
        <div class="col-auto mt-4">
            <p class="text-dark2">{{@count(Auth::user()->exam_user_session->exam_user_answers??[]).'/'.$exam->questions->count()}} Soal dikerjakan</p>
        </div>
    </div>
    <div class="row mt-2 ml-1">
        @php
        $no = 1;
        @endphp
        @foreach($exam->questions as $key => $value)
        <div class="col-auto p-0 ">
            <a class="btn btn-{{($key < @count(Auth::user()->exam_user_session->exam_user_answers??[]))?'primary':'outline-primary'}} m-1">
                    {{$no++}}
                </a>
            </div>
        @endforeach
    </div>
