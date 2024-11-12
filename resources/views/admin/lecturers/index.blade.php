@extends('admin.layouts.master', ['title' => 'Dosen'])
@section('content')
    <section class="section">
        @include('admin.layouts.breadcrumb', [
            'title' => 'Dosen',
            'breadcrumbs' => [
                [
                    'name' => 'Dosen',
                    'slug' => 'lecturers',
                ],
            ],
        ])
        <div class="section-body">
            <form method="GET" action="{{ route('lecturers.index') }}">
                <div class="card">
                    <div class="card-header">
                        <h4>Search Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row m-1">
                            <div class="col-sm-6">
                                <input type="text" class="form-control m-1" name="search" placeholder="Cari"
                                    value="{{ request()->get('search') }}">
                            </div>
                            <div class="col-sm-6">
                                <x-admins.inputs.study-program />
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
                            <a href="{{ route('lecturers.create') }}" class="btn btn-success flaot-left">Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Program Studi</th>
                                        <th>NIDN</th>
                                        <th>NRP</th>
                                        <th>Nama</th>
                                        <th>No. HP</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($lecturers as $lecture)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $lecture->study_program->name }}</td>
                                            <td>{{ $lecture->number }}</td>
                                            <td>{{ $lecture->code }}</td>
                                            <td>{{ $lecture->name }}</td>
                                            <td>{{ $lecture->phone }}</td>
                                            <td>{{ $lecture->statuses()[$lecture->status] }}</td>
                                            <td class="row m-auto">
                                                <a href="{{ route('lecturers.edit', $lecture->id) }}"
                                                    class="badge badge-primary">Edit</a>
                                                <form action="{{ route('lecturers.destroy', $lecture->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="badge badge-danger border-0 delete"
                                                        type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{ $lecturers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
