@extends('admin.layouts.master',['title'=>'Konversi Nilai Tes'])
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
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Nilai Konversi Akademik</h4>
              <div class="card-header-action">
                <a href="{{route('exam_scores.create', ['type' => 'AKADEMIK'])}}" class="btn btn-success float-right d-flex">Tambah</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Batas Nilai Atas</th>
                    <th>Batas Nilai Bawah</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($scores as $score)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$score->name}}</td>
                        <td>{{$score->start_score}}</td>
                        <td>{{$score->end_score}}</td>
                        <td>
                            <a href="{{route('exam_scores.edit', $score->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('exam_scores.destroy', $score->id)}}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger border-0 delete text-white" style="border: none;" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Nilai Konversi Non Akademik</h4>
              <div class="card-header-action">
                <a href="{{route('exam_scores.create', ['type' => 'NON_AKADEMIK'])}}" class="btn btn-success float-right d-flex">Tambah</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($non_scores as $score)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$score->name}}</td>
                        <td class="row m-auto">
                            <a href="{{route('exam_scores.edit', $score->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('exam_scores.destroy', $score->id)}}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger border-0 delete text-white" style="border: none;" type="submit">Delete</button>
                            </form>
                        </td>
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