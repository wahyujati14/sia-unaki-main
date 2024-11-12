@extends('admin.layouts.master', ['title' => 'Edit Fakultas'])
@section('content')
    <section class="section">
        @include('admin.layouts.breadcrumb', [
            'title' => 'Fakultas',
            'breadcrumbs' => [
                [
                    'name' => 'Fakultas',
                    'slug' => 'faculties',
                ],
            ],
        ])
        @include('sweetalert::alert')
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('faculties.update', $faculty->id) }}" method="POST">
                            <div class="card-header">
                                <h4>Fakultas</h4>
                            </div>
                            <div class="card-body">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" required
                                        value="{{ $faculty->name }}">
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


{{-- @extends('admin.layouts.master',['title'=>'Edit Fakultas'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Fakultas',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Fakultas', 
            'slug' => 'faculties'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('faculties.update', $faculty->id)}}" method="POST">
                <div class="card-header">
                <h4>Fakultas</h4>
                </div>
                <div class="card-body">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" required value="{{$faculty->name}}">
                    </div>
                    <div class="form-group">
                      <select name="study_program_id" id="" class="form-control m-1">
                          <option value="">Program Study</option>
                          @foreach ($study_programs as $study_program)
                            <option value="{{$study_program->id}}" {{(@$data['study_program_id'] == $study_program->id)?'selected':''}}>{{$study_program->name}}</option>
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
@endsection --}}
