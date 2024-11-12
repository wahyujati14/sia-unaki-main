@extends('admin.layouts.master', ['title' => 'KRS'])
@section('content')
    <section class="section">
        @include('admin.layouts.breadcrumb', [
            'title' => 'KRS',
            'breadcrumbs' => [
                [
                    'name' => 'KRS',
                    'slug' => 'study_plan_cards',
                ],
            ],
        ])
        <div class="section-body">
            <form method="GET" action="{{ route('study_plan_cards.index') }}">
                <div class="card">
                    <div class="card-header">
                        <h4>Search Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row m-1">
                            <div class="col-6">
                                <x-admins.inputs.academic-year :value="request()->get('academic_year_id')" />
                            </div>
                            <div class="col-6">
                                <x-admins.inputs.study-plan-card.status :value="request()->get('status')" />
                            </div>
                            <div class="col-12">
                                <x-admins.inputs.study-program :value="request()->get('study_program_id')" />
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
                            <div class="card-header-action">
                                <a href="{{ route('study_plan_cards.create') }}" class="btn btn-success">Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Prodi</th>
                                        <th>Mahasiswa</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @foreach ($cards as $card)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $card->academic_year->toDescriptionString() }}</td>
                                            <td>{{ $card->user->study_program_selected?->study_program?->name }}</td>
                                            <td>{{ $card->user->name }} - {{ $card->user->nim }}</td>
                                            <td>{{ $card->statuses()[$card->status] }}</td>
                                            <td class="row m-auto">
                                                <a href="{{ route('study_plan_cards.show', $card->id) }}"
                                                    class="badge badge-primary">Detail</a>
                                                <a href="{{ route('study_plan_cards.edit', $card->id) }}"
                                                    class="badge badge-primary">Edit</a>
                                                <form action="{{ route('study_plan_cards.destroy', $card->id) }}"
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
                                {{ $cards->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
