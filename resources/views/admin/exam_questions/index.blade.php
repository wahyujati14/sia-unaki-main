@extends('admin.layouts.master',['title'=>'Daftar Pertanyaan'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
      'title' => 'Daftar Pertanyaan',
      'breadcrumbs' =>
    [    
      [
          'name' => 'Daftar Pertanyaan', 
          'slug' => 'students'
      ]
    ]
  ])
  <div class="section-body">

    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4> Daftar Pertanyaan</h4>
            <div class="card-header-action">
              <a href="{{route('exam_questions.create')}}" class="badge badge-success">Tambah</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <tr>
                  <th>#</th>
                  <th>Soal</th>
                  <th>Pertanyaan</th>
                  <th>Gambar</th>
                  <th>Action</th>
                </tr>
                @foreach ($exam_questions as $exam_question)
                  <tr>
                      <td>{{$loop->iteration + $exam_questions->firstItem() - 1}}</td>
                      <td>{{$exam_question->exam->name}}</td>
                      <td>{{$exam_question->question}}</td>
                      <td><img src="{{asset('storage/'.$exam_question->image)}}" alt="" srcset="" class="img-thumbnail" width="100px"></td>
                      <td class="row m-auto">
                        <a href="{{route('exam_questions.edit', $exam_question->id)}}" class="badge badge-primary">Edit</a>
                        <form action="{{route('exam_questions.destroy', $exam_question->id)}}" method="POST" class="d-inline">
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
          @include('admin.layouts.paginate', ['paginators' => $exam_questions])
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

