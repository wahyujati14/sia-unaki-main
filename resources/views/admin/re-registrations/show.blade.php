@extends('admin.layouts.master',['title'=>'Daftar Ulang'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Daftar Ulang',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Daftar Ulang', 
            'slug' => 're_registrations'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-sm-12 col-lg-7">
            
            @include('admin.students.components.card-profile')
            @include('admin.students.components.card-information')
            @include('admin.students.components.card-sekolah-asal')
            
          </div>
          <div class="col-12 col-sm-12 col-lg-5">
            @include('admin.students.components.card-file')
            @include('admin.students.components.card-payments')
          </div>
      </div>
    </div>
</section>
@endsection