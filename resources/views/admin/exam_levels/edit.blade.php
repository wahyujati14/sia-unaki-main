@extends('admin.layouts.master',['title'=>'Edit Level Ujian'])
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
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('exam_levels.update', $exam_level->id)}}" method="POST">
                <div class="card-header">
                <h4>Level Ujian</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" value="{{$exam_level->name}}">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Update</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection

@push('js')
@endpush