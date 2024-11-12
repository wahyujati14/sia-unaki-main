@extends('admin.layouts.master',['title'=>'Edit Program Studi'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Program Studi',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Program Studi', 
            'slug' => 'cities'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('study_programs.update', $study_program->id)}}" method="POST">
                <div class="card-header">
                <h4>Program Studi</h4>
                </div>
                <div class="card-body">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" required value="{{$study_program->name}}">
                    </div>
                    <div class="form-group">
                      <label>Code</label>
                      <input type="text" class="form-control" name="code" required value="{{$study_program->code}}">
                    </div>
                    <div class="form-group">
                      <label>Fakultas</label>
                      <select name="faculty_id" id="" class="form-control" required>
                        <option value="">PILIH</option>
                        @foreach ($faculties as $faculty)
                          <option value="{{$faculty->id}}"{{($study_program->faculty_id == $faculty->id)?'selected':''}}>{{$faculty->name}}</option>
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
