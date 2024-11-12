@extends('admin.layouts.master',['title'=>'Login Admin'])
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Setting Soal Ujian',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Setting Soal Ujian', 
            'slug' => 'students'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <form action="{{route('exams.store')}}" method="POST">
                <div class="card-header">
                <h4>Setting Soal Ujian</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" required>
                    </div>
                    <div>
                        <label>Level Ujian</label>
                        <select name="exam_level_id" id="" class="form-control">
                            <option value="">PILIH</option>
                            @foreach ($exam_levels as $exam_level)
                            <option value="{{$exam_level->id}}">{{$exam_level->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Duration</label>
                      <input type="time" class="form-control" name="duration" step="1" required>
                    </div>
                    <div class="form-group">
                      <label class="d-block">Status</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="exampleRadios1"  value="1">
                        <label class="form-check-label" for="exampleRadios1">
                          Active
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="exampleRadios2" value="0">
                        <label class="form-check-label" for="exampleRadios2">
                          Unactive
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Jalur Pendaftaran</label>
                      <select class="form-control select2" name="registration_path_id[]" id="" multiple>
                        <option value="" disabled >PILIH</option>
                        @foreach ($registration_paths as $registration_path)
                          <option value="{{$registration_path->id}}">{{$registration_path->name}}</option>
                        @endforeach
                      </select>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush