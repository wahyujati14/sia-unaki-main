@extends('admin.layouts.master',['title'=>'Edit Konversi Nilai Tes'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Konversi Nilai Tes',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Konversi Nilai Tes', 
            'slug' => 'exam_scores'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('exam_scores.update', $score->id)}}" method="POST">
                <div class="card-header">
                <h4>Konversi Nilai Tes</h4>
                </div>
                <div class="card-body">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" required value="{{$score->name}}">
                    </div>
                    @if ($score->type == 'AKADEMIK')
                    <div class="form-group">
                      <label>Batas Nilai Atas</label>
                      <input type="text" class="form-control" name="start_score" required value="{{$score->start_score}}">
                    </div>
                    <div class="form-group">
                      <label>Batas Nilai Bawah</label>
                      <input type="text" class="form-control" name="end_score" required value="{{$score->end_score}}">
                    </div>
                    @endif
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
