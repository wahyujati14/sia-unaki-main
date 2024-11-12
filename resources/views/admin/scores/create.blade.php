@extends('admin.layouts.master',['title'=>'Tambah Konversi Nilai Tes'])
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
            <form action="{{route('exam_scores.store', ['type' => request()->type])}}" method="POST">
                <div class="card-header">
                <h4>Konversi Nilai Tes</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" required>
                    </div>
                    @if (request()->type == 'AKADEMIK')
                    <div class="form-group">
                      <label>Batas Nilai Atas</label>
                      <input type="tel" class="form-control" name="start_score" required size="4" maxlength="3" onchange="changeHandler(this)">
                    </div>
                    <div class="form-group">
                      <label>Batas Nilai Bawah</label>
                      <input type="tel" class="form-control" name="end_score" required size="4" maxlength="3" onchange="changeHandler(this)">
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
@push('js')
<script>
  function changeHandler(val)
  {
    if (Number(val.value) > 100)
    {
      val.value = 100
    }
  }
</script>
@endpush