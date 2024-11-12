@extends('admin.layouts.master',['title'=>'Assign Dosen'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Assign Dosen',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Assign Dosen', 
            'slug' => 'students/{id}/assign/lecturer'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('students.assign.lecturers.store', $student->id)}}" method="POST">
                <div class="card-header">
                <h4>Assign Dosen</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label>Dosen</label>
                        <x-admins.inputs.lecturer />
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                          @foreach($statuses as $index => $status)
                          <option value="{{ $index }}">{{ $status }}</option>
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
@endsection