@extends('admin.layouts.master',['title'=>'Login Admin'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
      'title' => 'Setting Soal Ujian',
      'breadcrumbs' =>
    [    
      [
          'name' => 'Setting Soal Ujian', 
          'slug' => 'students'
      ]
    ]
  ])
  <div class="section-body">

    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4> Setting Soal Ujian</h4>
            <div class="card-header-action">
              <a href="{{route('exams.create')}}" class="badge badge-success">Tambah</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Level Ujian</th>
                  <th>Duration</th>
                  <th>Status</th>
                  <th>Jumlah Pertanyaan</th>
                  <th>Jalur Pendaftaran</th>
                  <th>Action</th>
                </tr>
                @foreach ($exams as $exam)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$exam->name}}</td>
                      <td>{{$exam->exam_level->name}}</td>
                      <td>{{date('H:i:s', strtotime($exam->duration))}}</td>
                      <td>
                          <div id="is_active" class="m-1 badge badge-{{($exam->is_active)?'success':'danger'}}" onclick="changeStatus({{($exam->is_active)?0:1}}, {{$exam->id}})">{{($exam->is_active)?'Active':'Unactive'}}</div>
                      </td>
                      <td>{{count($exam->questions)}}</td>
                      <td>{{implode(', ', $exam->exam_registration_paths->pluck('registration_path.name')->toArray())}}</td>
                      <td class="row m-auto">
                        <a href="{{route('exams.edit', $exam->id)}}" class="badge badge-primary">Edit</a>
                        <form action="{{route('exams.destroy', $exam->id)}}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button class="badge badge-danger border-0 delete" type="submit" style="border:none;">Delete</button>
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
@push('js')
  <script>
    // $('#is_active').on('click', function (e) {
    //   var value = e;
    //   console.log(value);
    // })
    function changeStatus(is_active, id) {
      var url;
      url = "{{route('exams.update', ":id")}}"
      url = url.replace(':id', id);
      $.ajax({
        url: url,
        method:"POST",
        data: {
          is_active:is_active,
          _method:"PUT",
          _token: "{{ csrf_token() }}",
          dataType: "json",
          success: function (data) {
            new swal("Success", "Successfully change data", "success");
            location.reload();
          }
        },
      })
    }
  </script>
@endpush

