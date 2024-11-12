@extends('admin.layouts.master',['title'=>'Fakultas'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Fakultas',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Fakultas', 
            'slug' => 'faculties'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('faculties.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($faculties as $faculty)
                    <tr>
                        <td>{{$loop->iteration + $faculties->firstItem() - 1}}</td>
                        <td>{{$faculty->name}}</td>
                        <td class="row m-auto">
                            <a href="{{route('faculties.edit', $faculty->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('faculties.destroy', $faculty->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="badge badge-danger border-0 delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
            @include('admin.layouts.paginate', ['paginators' => $faculties])
          </div>
        </div>
      </div>
    </div>
</section>
@endsection