@extends('admin.layouts.master', ['title' => 'Admin'])

@section('content')
    <section class="section">
        @include('admin.layouts.breadcrumb', [
            'title' => 'Admin',
            'breadcrumbs' => [
                [
                    'name' => 'Admin',
                    'slug' => 'admins',
                ],
            ],
        ])
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admins.create') }}" class="btn btn-success flaot-left">Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Avatar</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $loop->iteration + $admins->firstItem() - 1 }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->username }}</td>
                                            <td> <img class="img-thumbnail" style="width: 30%"
                                                    src="{{ asset('storage/' . $admin->avatar) }}" alt=""></td>
                                            <td>{{ $admin->role?->name }}</td>
                                            <td class="row m-auto">
                                                <a href="{{ route('admins.edit', $admin->id) }}"
                                                    class="badge badge-primary">Edit</a>
                                                @if ($admin->id != 1 && Auth::guard('admin')->user()->role_id != $admin->role_id)
                                                    <form action="{{ route('admins.destroy', $admin->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="badge badge-danger border-0 delete"
                                                            type="submit">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        @include('admin.layouts.paginate', ['paginators' => $admins])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
