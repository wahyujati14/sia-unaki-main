@extends('admin.layouts.master',['title'=>'Tambah Ruangan'])
@section('content')
<section class="section">
    @include('admin.layouts.breadcrumb', [ 
        'title' => 'Ruangan',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Ruangan', 
            'slug' => 'rooms'
        ]
      ]
    ])
    @include('sweetalert::alert')
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="{{route('rooms.store')}}" method="POST">
                <div class="card-header">
                <h4>Ruangan</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required id="">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" name="description" class="form-control" required id="">
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