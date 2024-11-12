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
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
                <h4> Table</h4>
                <div class="card-header-action">
                    <a href="{{route('exam_sessions.create')}}" class="badge badge-success">Tambah</a>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($exam_sessions as $exam_session)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$exam_session->name}}</td>
                        <td>{{$exam_session->start_time}}</td>
                        <td>{{$exam_session->end_time}}</td>
                        <td class="row m-auto">
                          <a href="{{route('exam_sessions.edit', $exam_session->id)}}" class="badge badge-primary">Edit</a>
                          <form action="{{route('exam_sessions.destroy', $exam_session->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="badge badge-danger delete" type="submit" style="border:none;">Delete</button>
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

