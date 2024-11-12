@extends('admin.layouts.master', ['title' => 'Login Admin'])
@section('content')
    <section class="section">
        @include('admin.layouts.breadcrumb', [
            'title' => 'Pengajuan SKD Mahasiswa',
            'breadcrumbs' => [
                [
                    'name' => 'Pengajuan SKD Mahasiswa',
                    'slug' => 'students',
                ],
            ],
        ])
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengajuan SKD Mahasiswa</h4>
                        <div class="card-header-action">
                            <form method="GET" action="{{ route('certificate_receives.index') }}">
                                <div class="form-group row m-1">
                                    <select name="submission" id="" class="form-control m-1 status-filter">
                                        <option value="">Filter Status</option>
                                        <option value="true" {{ @$data['submission'] === true ? 'selected' : '' }}>Diterima
                                        </option>
                                        <option value="false" {{ @$data['submission'] === false ? 'selected' : '' }}>Belum
                                            Diterima</option>
                                    </select>
                                </div>
                        </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Nomor SKD</th>
                                    <th>Program Studi</th>
                                    <th>Status Pengajuan</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($certificate_receives as $certificate_receive)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $certificate_receive->user->name }}</td>
                                        <td>{{ $certificate_receive->nomor_certificate }}</td>
                                        <td>
                                            @if ($certificate_receive->study_program)
                                                {{ @$certificate_receive->study_program->name }}
                                            @else
                                                <a href="#" class="badge badge-primary program-study"
                                                    data-select="{{ $certificate_receive->user->user_study_program->pluck('study_program.name', 'id') }}">Pilih
                                                    Program Studi</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a
                                                class="text-white badge bg-{{ $certificate_receive->submission == 1 ? 'success' : '' }}">{{ $certificate_receive->submission == 1 ? 'Diterima' : '' }}</a>
                                        </td>
                                        <td class="row m-auto">
                                            {{-- <a href="{{route('certificate_receives.edit', $certificate_receive->id)}}" class="badge badge-primary">Detail</a> --}}
                                            {{-- <a href="{{route('certificate_receives.show', [$certificate_receive->id, 'type' => 'download'])}}" class="badge badge-danger" target="_blank">Download SKD</a> --}}
                                            @if ($certificate_receive->submission)
                                                <a href="{{ route('certificate_receives.show', [$certificate_receive->id, 'type' => 'view']) }}"
                                                    class="badge badge-primary" target="_blank">View SKD</a>
                                            @endif

                                            @if ($certificate_receive->study_program && $certificate_receive->submission == false)
                                                <form
                                                    action="{{ route('certificate_receives.update', $certificate_receive->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="submission" value="true">
                                                    <button type="submit" style="border: none;"
                                                        class="badge badge-success approve">Approve</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    @include('admin.layouts.paginate', ['paginators' => $certificate_receives])
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.status-filter').on('change', function(e) {
            var form = $(this).closest("form");
            form.submit();
        })
    </script>
    <script>
        $('.program-study').on('click', function(e) {
            new swal({
                    title: `Please Choose One`,
                    text: "Silahkan Pilih Dosen Wali",
                    input: 'select',
                    inputOptions: $(this).data("select"),
                    showCancelButton: true,
                    inputValidator: function(value) {
                        return new Promise(function(resolve, reject) {
                            if (value !== '') {
                                $.ajax({
                                    url: "{{ url('admin/user_study_programs') }}/" + value,
                                    method: "POST",
                                    data: {
                                        _method: "PUT",
                                        _token: "{{ csrf_token() }}",
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        console.log('oke')
                                    }
                                })
                                resolve();
                            } else {
                                resolve('You need to select a Program Study');
                            }
                        });
                    }
                })
                .then((willSelect) => {
                    if (willSelect.isConfirmed) {
                        new swal("Success", "Successfully change data", "success");
                    }
                    location.reload();
                });
        })

        function select_study_program(form) {
            Swal.fire({
                title: 'Anda yakin memilih program study berikut ??',
                icon: "question",
                showCancelButton: true,
                cancelButtonText: 'Batal',
                inputValue: 0,
                confirmButtonText: 'Submit',
            }).then(function(isConfirmed) {
                if (isConfirmed.value == 1) {
                    form.submit();
                    return true;
                } else {
                    return false
                }
            });
            return false;
        }
    </script>
@endpush
