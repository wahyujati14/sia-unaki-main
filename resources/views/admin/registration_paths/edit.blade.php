@extends('admin.layouts.master',['title'=>'Edit Jalur Pendaftaran'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Jalur Pendaftaran',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Jalur Pendaftaran', 
            'slug' => 'registration_paths'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('registration_paths.update', $registration_path->id)}}" method="POST">
                <div class="card-header">
                <h4>Jalur Pendaftaran</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" value="{{$registration_path->name}}" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" class="form-control" name="description" required>{{$registration_path->description}}</textarea>
                    </div>
                    <div class="form-group">
                      <label>Slug</label>
                      <input type="text" class="form-control" name="slug" value="{{$registration_path->slug}}" required>
                    </div>
                    <div class="form-group">
                      <label>Code</label>
                      <input type="text" class="form-control" name="code" value="{{$registration_path->code}}" required>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select name="is_active" id="" class="form-control">
                        <option value="true" {{($registration_path->is_active == true)?'selected':''}}>Aktif</option>
                        <option value="false" {{($registration_path->is_active == false)?'selected':''}}>Tidak Aktif</option>
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
@endpush