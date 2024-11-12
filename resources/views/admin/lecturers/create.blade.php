@extends('admin.layouts.master', ['title' => 'Tambah Dosen'])
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
        @include('sweetalert::alert')
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('lecturers.store') }}" method="POST">
                            <div class="card-header">
                                <h4>Dosen</h4>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label>Program Studi</label>
                                    <x-admins.inputs.study-program required />
                                </div>
                                <div class="form-group">
                                    <label>Gelar Pendidikan</label>
                                    <input type="text" name="academic_degree" class="form-control" required
                                        id="">
                                </div>
                                <div class="form-group">
                                    <label>NIDN</label>
                                    <input type="text" name="number" class="form-control" required id="">
                                </div>
                                <div class="form-group">
                                    <label>NRP</label>
                                    <input type="text" name="code" class="form-control" required id="">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" value="" class="form-control" required
                                        id="">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" required id="">
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" name="phone" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="address" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <x-admins.inputs.lecturer.status required />
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
