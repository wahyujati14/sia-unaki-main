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
            <form action="{{route('user_class_courses.update', $user_class_course->id)}}" method="POST">
                <div class="card-header">
                <h4>Kelas Mahasiswa</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Kelas Kuliah</label>
                        <x-admins.inputs.class-course value="{{ $user_class_course->class_course_id }}" required/>
                    </div>
                    <div class="form-group">
                        <label>KRS</label>
                        <x-admins.inputs.study-plan-card value="{{ $user_class_course->study_plan_card_id }}" required />
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