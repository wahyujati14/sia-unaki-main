@extends('admin.layouts.master',['title'=>'Level Ujian'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Level Ujian',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Level Ujian', 
            'slug' => 'exam_levels'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
                <h4> Table</h4>
                <div class="card-header-action">
                    <a href="{{route('exam_levels.create')}}" class="badge badge-success">Tambah</a>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($exam_levels as $exam_level)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$exam_level->name}}</td>
                        <td class="row m-auto">
                          <a href="{{route('exam_levels.edit', $exam_level->id)}}" class="badge badge-primary">Edit</a>
                          <form action="{{route('exam_levels.destroy', $exam_level->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="badge badge-danger border-0 delete" type="submit" style="border:none;">Delete</button>
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

