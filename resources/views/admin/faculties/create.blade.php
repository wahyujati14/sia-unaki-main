@extends('admin.layouts.master',['title'=>'Tambah Fakultas'])
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
            <form action="{{route('faculties.store')}}" method="POST">
                <div class="card-header">
                <h4>Fakultas</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" required>
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