@extends('admin.layouts.master',['title'=>'File Uoload'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'File Uoload',
        'breadcrumbs' =>
      [    
        [
            'name' => 'File Uoload', 
            'slug' => 'file_uploads'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('file_uploads.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($file_uploads as $file_upload)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$file_upload->name}}</td>
                        <td>{{$file_upload->size}}</td>
                        <td>{{$file_upload->type}}</td>
                        <td>{{$file_upload->description}}</td>
                        <td class="row m-auto">
                          <a href="{{route('file_uploads.edit', $file_upload->id)}}" class="badge badge-primary">Edit</a>
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

