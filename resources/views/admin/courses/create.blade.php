@extends('admin.layouts.master',['title'=>'Tambah Mata Kuliah'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Mata Kuliah',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Mata Kuliah', 
            'slug' => 'courses'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('courses.store')}}" method="POST">
                <div class="card-header">
                <h4>Mata Kuliah</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label>Program Studi</label>
                        <x-admins.inputs.study-program required/>
                    </div>
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" name="code" class="form-control" required id="">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required id="">
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