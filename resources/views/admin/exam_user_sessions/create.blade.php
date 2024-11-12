@extends('admin.layouts.master',['title'=>'Hasil Ujian Mahasiswa'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Hasil Ujian Mahasiswa',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Hasil Ujian Mahasiswa', 
            'slug' => 'exam_sessions'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <form action="{{route('exam_user_sessions.store')}}" method="POST">
                <div class="card-header">
                <h4>Hasil Ujian Mahasiswa</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                      <label for="">Mahasiswa</label>
                      <select name="user_id" id="" class="form-control" required>
                        <option value="">PILIH</option>
                        @foreach ($users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Sesi Ujian</label>
                      <select name="exam_session_id" id="" class="form-control" required>
                        <option value="">PILIH</option>
                        @foreach ($exam_sessions as $exam_session )
                          <option value="{{$exam_session->id}}">{{$exam_session->name}}</option>
                        @endforeach
                      </select>
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