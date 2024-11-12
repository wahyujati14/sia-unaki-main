@extends('admin.layouts.master',['title'=>'Program Studi'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [
        'title' => 'Program Studi',
        'breadcrumbs' =>
      [
        [
            'name' => 'Program Studi',
            'slug' => 'study_programs'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('study_programs.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Fakultas</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($study_programs as $study_program)
                    <tr>
                        <td>{{$loop->iteration + $study_programs->firstItem() - 1}}</td>
                        <td>{{$study_program->name}}</td>
                        <td>{{$study_program->code}}</td>
                        <td>{{$study_program->faculty->name}}</td>
                        <td class="row m-auto">
                            <a href="{{route('study_programs.edit', $study_program->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('study_programs.destroy', $study_program->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger border-0 delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
            @include('admin.layouts.paginate', ['paginators' => $study_programs])
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
