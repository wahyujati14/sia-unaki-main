<div class="card card-primary">
    <div class="card-header">
        <h4>Informasi Pendafataran</h4>
    </div>
    <div class="card-body">
        <table>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $student->user_information?->gender == 'MALE' ? 'LAKI - LAKI' : 'PEREMPUAN' }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $student->user_information?->religion?->name }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $student->user_information?->birth_place . ', ' . date('Y-m-d', strtotime($student->user_information?->birth)) }}
                </td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>:</td>
                <td>{{ $student->user_information?->province?->name }}</td>
            </tr>
            <tr>
                <td>Kota</td>
                <td>:</td>
                <td>{{ $student->user_information?->city?->name }}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td>{{ $student->user_information?->district?->name }}</td>
            </tr>
            <tr>
                <td>Kelurahan</td>
                <td>:</td>
                <td>{{ $student->user_information?->sub_district?->name }}</td>
            </tr>
            <tr>
                <td>Alamat Sekarang</td>
                <td>:</td>
                <td>{{ $student->user_information?->current_address }}</td>
            </tr>
            <tr>
                <td>Alamat Sesuai KTP</td>
                <td>:</td>
                <td>{{ $student->user_information?->identity_address }}</td>
            </tr>
            <tr>
                <td>Nama Orang Tua</td>
                <td>:</td>
                <td>{{ $student->user_information?->parent_name }}</td>
            </tr>
            <tr>
                <td>Ibu Kandung</td>
                <td>:</td>
                <td>{{ $student->user_information?->biological_mother }}</td>
            </tr>
            <tr>
                <td>Nomor Orang Tua</td>
                <td>:</td>
                <td>{{ $student->user_information?->parent_phone }}</td>
            </tr>
            <tr>
                <td>Alamat Orang Tua</td>
                <td>:</td>
                <td>{{ $student->user_information?->parent_address }}</td>
            </tr>
        </table>
    </div>
</div>
