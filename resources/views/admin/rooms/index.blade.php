@extends('admin.layouts.master',['title'=>'Ruangan'])
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
    <div class="section-body">
      <form method="GET" action="{{ route('rooms.index') }}">
        <div class="card">
          <div class="card-header">
            <h4>Search Form</h4>
          </div>
          <div class="card-body">
            <div class="form-group row m-1">
              <div class="col-12">
                <input type="text" class="form-control m-1" name="search" placeholder="Cari" value="{{ request()->get('search') }}">
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Cari</button>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('rooms.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Nama Ruangan</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->description }}</td>
                        <td class="row m-auto">
                            <a href="{{route('rooms.edit', $room->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('rooms.destroy', $room->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger border-0 delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </table>
                {{ $rooms->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection