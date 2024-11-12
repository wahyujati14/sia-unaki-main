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
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header row align-items-start">
                        <div class="col-12 col-lg-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Nama Mahasiswa</td>
                                        <td>{{ $card->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">NIM</td>
                                        <td>{{ $card->user->nim }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tahun Ajaran</td>
                                        <td>{{ $card->academic_year->toDescriptionString() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Semester</td>
                                        <td>{{ $card->user->getCurrentSemester($card->academic_year_id) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Fakultas</td>
                                        {{-- <td>{{ $card->user->study_program_selected->study_program->faculty->name }}</td> --}}
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Program Studi</td>
                                        {{-- <td>{{ $card->user->study_program_selected->study_program->name }}</td> --}}
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Dosen Wali</td>
                                        {{-- <td>{{ $card->user->lecturer->first()?->name }}</td> --}}
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Status</td>
                                        <td>{{ $card->statuses()[$card->status] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-lg-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Total SKS</td>
                                        <td>{{ $card->getCreditCourseTotalAttribute() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">IPK</td>
                                        <td>{{ $card->user->cummulative_performance_index }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">IPS</td>
                                        <td>{{ $card->user->ongoing_semester_performance_index }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row m-auto">
                            <table class="table table-light table-bordered w-100">
                                <thead class="w-100">
                                    <tr>
                                        <th>Mata Kuliah</th>
                                        <th>Dosen</th>
                                        <th>SKS</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody class="w-100">
                                    @foreach ($card->user_class_courses as $class)
                                        <tr>
                                            <td>{{ $class->class_course->course->code }} -
                                                {{ $class->class_course->course->name }}</td>
                                            {{-- <td>{{ $class->class_course->lecturer->name }}</td> --}}
                                            <td>{{ $class->credit_course }}</td>
                                            {{-- <td>{{ $class->study_result_card->letter_value }}</td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
