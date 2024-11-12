@extends('admin.layouts.master', ['title' => 'Login Admin'])
@section('content')
    <section class="section">
        @include('admin.layouts.breadcrumb', [
            'title' => 'Hasil Ujian Mahasiswa',
            'breadcrumbs' => [
                [
                    'name' => 'Hasil Ujian Mahasiswa',
                    'slug' => 'students',
                ],
            ],
        ])
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4> Hasil Ujian Mahasiswa</h4>
                            <div class="card-header-action">
                                <a href="{{ route('exam_user_sessions.create') }}"
                                    class="btn btn-success float-right d-flex">Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Ujian</th>
                                        <th>Nilai</th>
                                        <th>Kategori Nilai</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($user_exams as $user_exam)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user_exam->user?->name ?? '' }}</td>
                                            <td>{{ $user_exam->user?->user_information?->registration_path?->exam_registration_path?->exam?->name ?? '' }}
                                            </td>
                                            @php
                                                $score =
                                                    ($user_exam
                                                        ->exam_user_answers()
                                                        ->whereHas('exam_answer', function ($query) {
                                                            $query->where('is_correct', true);
                                                        })
                                                        ->count($user_exam->exam_user_answers) /
                                                        count($user_exam->exam_user_answers)) * 100;
                                            @endphp
                                            <td>{{ $score }}</td>
                                            <td>{{ \App\Models\ExamScore::getExamScore($score) }}</td>
                                            <td>
                                                @if (!$user_exam->is_success && !$user_exam->is_failed)
                                                    <form action="{{ route('exam_user_sessions.update', $user_exam->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" value="true" name="is_success">
                                                        <button type="submit" style="border:none;"
                                                            class="badge badge-success approve">Approve</button>
                                                    </form>
                                                    <form action="{{ route('exam_user_sessions.update', $user_exam->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" value="true" name="is_failed">
                                                        <button type="submit" style="border:none;"
                                                            class="badge badge-danger decline">Decline</button>
                                                    </form>
                                                @elseif($user_exam->is_success && !$user_exam->is_failed)
                                                    <p class="badge bg-success text-light">Diterima</p>
                                                @elseif(!$user_exam->is_success && $user_exam->is_failed)
                                                    <p class="badge bg-danger text-light">Ditolak</p>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- @if (!$user_exam->actual_score)
                          <form action="{{route('exam_user_sessions.update', $user_exam->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="true" name="is_success">
                            <button type="submit" style="border:none;" class="badge badge-success approve">Approve</button>
                          </form>
                          <form action="{{route('exam_user_sessions.update', $user_exam->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="false" name="is_success">
                            <button type="submit" style="border:none;" class="badge badge-danger border-0 decline">Decline</button>
                          </form>
                        @endif --}}
                                                <a href="{{ route('exam_user_sessions.show', $user_exam->id) }}"
                                                    class="badge badge-primary">Detail</a>
                                                <form action="{{ route('exam_user_sessions.destroy', $user_exam->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="badge badge-danger delete" type="submit"
                                                        style="border:none;">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        @include('admin.layouts.paginate', ['paginators' => $user_exams])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
