@extends('admin.layouts.master',['title'=>'Agama'])
@section('content')
<section class="section">
      @include('admin.layouts.breadcrumb', [ 
        'title' => 'Agama',
        'breadcrumbs' =>
      [    
        [
            'name' => 'Agama', 
            'slug' => 'religions'
        ]
      ]
    ])
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="{{route('religions.create')}}" class="btn btn-success flaot-left">Tambah</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($religions as $religion)
                    <tr>
                        <td>{{$loop->iteration + $religions->firstItem() - 1}}</td>
                        <td>{{$religion->name}}</td>
                        <td class="row m-auto">
                            <a href="{{route('religions.edit', $religion->id)}}" class="badge badge-primary">Edit</a>
                            <form action="{{route('religions.destroy', $religion->id)}}" method="post">
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
            @include('admin.layouts.paginate', ['paginators' => $religions])
          </div>
        </div>
      </div>
    </div>
</section>
@endsection