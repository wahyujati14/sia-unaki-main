@extends('admin.layouts.master',['title'=>'Login Admin'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'File Upload',
        'breadcrumbs' =>
      [    
        [
            'name' => 'File Upload', 
            'slug' => 'file_uploads'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
          <div class="card">
            <form action="{{route('file_uploads.update', $file_upload->id)}}" method="POST">
                <div class="card-header">
                <h4>File Upload</h4>
                </div>
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" value="{{$file_upload->name}}">
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" name="description" required>{{$file_upload->description}}</textarea>
                    </div>
                    <div class="form-group">
                      <label>Size</label>
                      <input type="number" class="form-control" name="size" value="{{$file_upload->size}}">
                    </div>
                    @php
                        $types = ["jpg","jpeg","gif","png","pdf"];
                    @endphp
                    <div class="form-group">
                        <label class="d-block">Status</label>
                    @foreach ($types as $type)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="type[]" id="file_uploadpleRadios1" {{(in_array($type, json_decode($file_upload->type)))?'checked':''}} value="{{$type}}">
                            <label class="form-check-label" for="file_uploadpleRadios1">
                            {{$type}}
                            </label>
                        </div>
                        @endforeach
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