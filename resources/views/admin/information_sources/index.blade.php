@extends('admin.layouts.master',['title'=>'Sumber Informasi'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Sumber Informasi',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Sumber Informasi', 
            'slug' => 'information_sources'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('information_sources.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($information_sources as $information_source)
                    <tr>
                        <td>{{$loop->iteration + $information_sources->firstItem() - 1}}</td>
                        <td>{{$information_source->name}}</td>
                        <td class="row m-auto">
                            <a href="{{route('information_sources.edit', $information_source->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('information_sources.destroy', $information_source->id)}}" method="post">
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
            @include('admin.layouts.paginate', ['paginators' => $information_sources])
          </div>
        </div>
      </div>
    </div>
</section>
@endsection