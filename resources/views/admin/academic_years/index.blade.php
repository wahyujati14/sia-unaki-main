@extends('admin.layouts.master',['title'=>'Tahun Akademik'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Tahun Akademik',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Tahun Akademik', 
            'slug' => 'academic_years'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('academic_years.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Tahun</th>
                    <th>Semester</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($academic_years as $academic_year)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$academic_year->first_year}} / {{$academic_year->last_year}}</td>
                        <td>{{$academic_year->odd_even}}</td>
                        <td class="row m-auto">
                            <a href="{{route('academic_years.edit', $academic_year->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('academic_years.destroy', $academic_year->id)}}" method="post">
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
          </div>
        </div>
      </div>
    </div>
</section>
@endsection