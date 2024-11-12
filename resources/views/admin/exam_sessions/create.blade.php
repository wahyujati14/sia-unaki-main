@extends('admin.layouts.master',['title'=>'Sesi Ujian'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Sesi Ujian',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Sesi Ujian', 
            'slug' => 'exam_sessions'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('exam_sessions.store')}}" method="POST">
                <div class="card-header">
                <h4>Sesi Ujian</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                      <label>Waktu Mulai</label>
                      <input type="time" class="form-control" name="start_time">
                    </div>
                    <div class="form-group">
                      <label>Waktu Selesai</label>
                      <input type="time" class="form-control" name="end_time">
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
@endpush