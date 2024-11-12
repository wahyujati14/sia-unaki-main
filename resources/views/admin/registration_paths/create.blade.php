@extends('admin.layouts.master',['title'=>'Tambah Jalur Pendaftaran'])
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
            <form action="{{route('registration_paths.store')}}" method="POST">
                <div class="card-header">
                <h4>Jalur Pendaftaran</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name"  required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" class="form-control" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                      <label>Slug</label>
                      <input type="text" class="form-control" name="slug"  required>
                    </div>
                    <div class="form-group">
                      <label>Code</label>
                      <input type="text" class="form-control" name="code" required>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select name="is_active" id="" class="form-control">
                        <option value="true" >Aktif</option>
                        <option value="false" >Tidak Aktif</option>
                      </select>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Tambah</button>
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