@extends('admin.layouts.master',['title'=>'Edit Sumber Informasi'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Sumber Informasi',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Sumber Informasi', 
            'slug' => 'cities'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('information_sources.update', $information_source->id)}}" method="POST">
                <div class="card-header">
                <h4>Sumber Informasi</h4>
                </div>
                <div class="card-body">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" required value="{{$information_source->name}}">
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