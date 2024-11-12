@extends('layouts.app',['title'=>'Home Pendaftaran Peneriman Mahasiswa Baru'])
@push('style')
<style>
    .card-exam{
        font-family: 'Lato',sans-serif !important;
        background-color: #4762EF;
        border-radius: 12px;
        padding: 20px 25px;
    }
</style>
@endpush
@section('content')
<div class="container-fluid pt-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4" style="min-height: 60vh;">
                @include('penerimaan-mahasiswa-baru.announcement')
                <div class="card-body bg-grey3">
                    <p class="text-dark informasi-pribadi-title">Informasi Pribadi</p>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="label-informasi-pribadi">NAMA LENGKAP</label>
                                <p class="value-informasi-pribadi">{{Auth::user()->name}}</p>
                            </div>
                            <div class="form-group">
                                <label class="label-informasi-pribadi">JALUR TEST</label>
                                <p class="value-informasi-pribadi">{{Auth::user()->user_information->registration_path->name}}</p>
                            </div>
                            <div class="form-group">
                                <label class="label-informasi-pribadi">PROGRAM STUDI PILIHAN PERTAMA</label>
                                <p class="value-informasi-pribadi">{{Auth::user()->study_program_first()}}</p>
                            </div>
                            <div class="form-group">
                                <label class="label-informasi-pribadi">PROGRAM STUDI PILIHAN KEDUA</label>
                                <p class="value-informasi-pribadi">{{Auth::user()->study_program_second()}}</p>
                            </div>
                            <div class="form-group">
                                <label class="label-informasi-pribadi">TEMPAT LAHIR</label>
                                <p class="value-informasi-pribadi">{{Auth::user()->user_information->birth_place}}</p>
                            </div>
                            <div class="form-group">
                                <label class="label-informasi-pribadi">TANGGAL LAHIR</label>
                                <p class="value-informasi-pribadi">{{\Carbon\Carbon::parse(Auth::user()->user_information->birth_date)->translatedFormat("d F Y")}}</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">PROVINSI</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->user_information->province->name}}</p>
                            </div>
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">KOTA / KABUPATEN</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->user_information->city->name}}</p>
                            </div>
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">KECAMATAN</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->user_information->district->name}}</p>
                            </div>
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">KELURAHAN / DESA</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->user_information->sub_district->name}}</p>
                            </div>
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">ALAMAT</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->user_information->current_address}}</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">AGAMA</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->user_information->religion->name}}</p>
                            </div>
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">NAMA IBU KANDUNG</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->user_information->biological_mother}}</p>
                            </div>
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">JENIS KELAMIN</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->user_information->gender == 'MALE' ? 'LAKI - LAKI' : 'PEREMPUAN' }}</p>
                            </div>
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">NOMOR HANDPHONE / WHATSAPP</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->phone }}</p>
                            </div>
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">EMAIL</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-grey3 mt-3">
                    <p class="text-dark informasi-pribadi-title">Informasi ASAL SEKOLAH</p>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">ASAL SEKOLAH</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->school_origin->name}}</p>
                            </div>
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">JURUSAN</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->school_origin->major}}</p>
                            </div>
                            <div class="form-group">
                                    <label class="label-informasi-pribadi">LULUSAN TAHUN</label>
                                    <p class="value-informasi-pribadi">{{Auth::user()->school_origin->graduation_year}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card-body">
                @include('penerimaan-mahasiswa-baru.contact_us')
            </div>
        </div>

        </div>
</div>
@endsection
@push('script')
<script>
    $('.confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          new swal({
              title: `Are you sure you want to select this?`,
              icon: "warning",
              showCancelButton: true,
          })
          .then((willApprove) => {
            if (willApprove.isConfirmed) {
              form.submit();
            }
          });
      });
</script>
@endpush
