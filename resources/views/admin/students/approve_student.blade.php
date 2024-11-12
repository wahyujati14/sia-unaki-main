@extends('admin.layouts.master',['title'=>'Login Admin'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Mahasiswa',
        'breadcrumbs' =>
      [    
        [
            'name' => 'User Mahasiswa', 
            'slug' => 'students'
        ]
      ]
    ])
    <div class="section-body">

    <form method="GET" action="{{ route('students.index') }}">
      <div class="card">
        <div class="card-header">
          <h4>Search Form</h4>
        </div>
        <div class="card-body">
          <div class="form-group row m-1">
            <div class="col-sm-6">
              <input type="text" class="form-control m-1" name="name" placeholder="Name" value="{{@$data['name']}}">
            </div>
            <div class="col-sm-6">
              <input type="text" class="form-control m-1" name="email" placeholder="Email" value="{{@$data['email']}}">
            </div>
            <div class="col-sm-6">
              <input type="text" class="form-control m-1" name="phone" placeholder="Phone" value="{{@$data['phone']}}">
            </div>
            <div class="col-sm-6">
              <input type="date" class="form-control m-1" name="created_at" placeholder="Date" value="{{@$data['created_at']}}">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary float-right">Cari</button>
        </div>
      </div>
    </form>

      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4> Table</h4>
            </div>
            <div class="card-body">
              <form action="{{route('approve_students.store')}}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="lecturer_id" id="lecturer_id" class="lecturer_id">
                <button type="submit" class="btn btn-primary modal-assign-checked float-right mb-3">Assign Dosen</button>
              </form>
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Register At</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($approve_students as $user)
                    <tr>
                        <td><input type="checkbox" name="checkbox[]" class="d-inline" value="{{$user->id}}"></td>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{date('Y-m-d H:i:s', strtotime($user->created_at))}}</td>
                        <td>
                            <div class="m-1 badge badge-{{($user->email_verified_at)?'success':'secondary'}}">Verifikasi Email</div>
                            <div class="m-1 badge badge-{{($user->user_information)?'success':'secondary'}}">Kelengkapan Data</div>
                            <div class="m-1 badge badge-{{($user->school_origin)?'success':'secondary'}}">Sekolah Asal</div>
                            <div class="m-1 badge badge-{{($user->user_information?->registration_path_id)?'success':'secondary'}}">Pilih Jalur</div>
                            <div class="m-1 badge badge-{{(count($user->user_file_upload) > 0)?'success':'secondary'}}">Upload File</div>
                        </td>
                        <td class="row d-flex">
                          <a href="{{route('students.show', $user->id)}}" class="btn btn-primary d-inline">Detail</a>
                          <form action="{{route('students.destroy', $user->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete">Delete</button>
                          </form>
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
            @include('admin.layouts.paginate', ['paginators' => $approve_students])
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    let form;
    var lecturers;
      $('.modal-assign-checked').click(function(event) {
        var checked = $("input:checkbox").prop('checked', $(this).prop("checked"));
        event.preventDefault();
        $.each(checked.serializeArray(), function(i, data) {
          form =  $(this).closest("form");
          var value = data.value;
          var study_program_id = 'all';
          submit(study_program_id);
          // console.log(form.serializeArray());
        });
      })
      $('.modal-assign').click(function(event) {
          form =  $(this).closest("form");
          var study_program_id = form.serializeArray()[2].value;
          event.preventDefault();
          submit(study_program_id);
      });

      function submit(study_program_id = 'all') {
        $.ajax({
          url: "{{url('admin/approve_students/study_program')}}",
          data: {
              id: study_program_id
          },
          dataType: "json",
          success: function (data) {
              var dosen = data;
              new swal({
                  title: `Please Choose One`,
                  text: "Silahkan Pilih Dosen Wali",
                  input: 'select',
                  inputOptions: {
                    '':'PILIH',
                    dosen,
                  },
                  showCancelButton: true,
                  inputValidator: function (value) {
                    return new Promise(function (resolve, reject) {
                      if (value !== '') {
                        $('.lecturer_id').val(value);
                        resolve();
                      } else {
                        resolve('You need to select a Lecturer');
                      }
                    });
                  }
                })
              .then((willSelect) => {
                console.log(willSelect.isConfirmed)
                if (willSelect.isConfirmed) {
                  form.submit();
                }
              });
          },
          error: function (xhr, ajaxOptions, thrownError) {
              swal("Error something!", "Please try again", "error");
          }
        });
      }



</script>

@endpush
