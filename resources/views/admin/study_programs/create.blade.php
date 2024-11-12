@extends('admin.layouts.master',['title'=>'Tambah Program Studi'])
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
            <form action="{{route('study_programs.store')}}" method="POST">
                <div class="card-header">
                <h4>Program Studi</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                      <label>Code</label>
                      <input type="text" class="form-control" name="code" required>
                    </div>
                    <div class="form-group">
                      <label>Fakultas</label>
                      <select name="faculty_id" id="" class="form-control" required>
                        <option value="">PILIH</option>
                        @foreach ($faculties as $faculty)
                          <option value="{{$faculty->id}}">{{$faculty->name}}</option>
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