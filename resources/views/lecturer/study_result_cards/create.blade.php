@extends('admin.layouts.master',['title'=>'Tambah Kelas Mahasiswa'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Kelas Mahasiswa',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Kelas Mahasiswa', 
            'slug' => 'user_class_courses'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('user_class_courses.store')}}" method="POST">
                <div class="card-header">
                <h4>Kelas Mahasiswa</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label>Kelas Kuliah</label>
                        <x-admins.inputs.class-course required/>
                    </div>
                    <div class="form-group">
                        <label>KRS</label>
                        <x-admins.inputs.study-plan-card required />
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