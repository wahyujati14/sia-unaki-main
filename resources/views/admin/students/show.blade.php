@extends('admin.layouts.master', ['title' => 'Login Admin'])
@section('content')
    <section class="section">
        @include('admin.layouts.breadcrumb', [
            'title' => 'Detail User',
            'breadcrumbs' => [
                [
                    'name' => 'User Mahasiswa',
                    'slug' => 'students',
                ],
                [
                    'name' => 'Detail User Mahasiswa',
                    'slug' => 'students/' . $student->id,
                ],
            ],
        ])

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-sm-12 col-lg-7">
                    @include('admin.students.components.card-profile')
                    @include('admin.students.components.card-information')
                    @include('admin.students.components.card-sekolah-asal')
                </div>
                <div class="col-12 col-sm-12 col-lg-5">
                    @include('admin.students.components.card-academic')
                    @include('admin.students.components.card-file')
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <!-- jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- sweetalert 2 -->
    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var toast = Swal.mixin({
            toast: true,
            title: 'General Title',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        function send_registration(form) {
            Swal.fire({
                title: 'Anda yakin ingin konfirmasi data berikut ??',
                text: 'Pastikan data terisi dengan benar.',
                input: 'checkbox',
                icon: "question",
                showCancelButton: true,
                cancelButtonText: 'Batal',
                inputValue: 0,
                inputPlaceholder: 'Saya yakin verifikasi sekarang',
                confirmButtonText: 'Submit',
                inputValidator: function(result) {
                    if (result == 0) {
                        toast.fire({
                            animation: true,
                            title: 'Silakan klik ceklis sebelum klik submit',
                            icon: 'warning'
                        });
                    }
                }
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
