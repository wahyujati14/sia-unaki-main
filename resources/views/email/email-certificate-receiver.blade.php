<section class="content">
    <div class="">
        <div class="letter-received">
            <img src="{{ asset('assets/images/logos/UNAKI-Logo-Universitas-300x107.png') }}"
                class="img-fluid rounded float-end" alt="logo" />
            <div class="letter-received-title">
                <h4>SURAT KETERANGAN DITERIMA</h4>
                <h4>No : {{ $user->certificate_receive->nomor_certificate }}</h4>
            </div>
            <div class="pl-5 pr-5">
                <p>
                    Berdasarkan hasil seleksi ujian masuk Universitas AKI Tahun Akademik 2022/2023, diputuskan
                    bahwa
                    <br />
                    nama berikut dinyatakan :
                </p>
                <table>
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $name }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Registrasi</td>
                            <td>:</td>
                            <td>{{ $user->user_registration()->external_id }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="received-title">
                <h1>DITERIMA</h1>
            </div>
            <div class="pl-5 pr-5">
                <p>Sebagai mahasiswa baru Universitas AKI Tahun Akademik 2022 / 2023 pada :</p>
                <table>
                    <tbody>
                        <tr>
                            <td>Fakultas</td>
                            <td>:</td>
                            {{-- <td>{{ $user->study_program_selected()->first()->study_program->faculty->name }}</td> --}}
                        </tr>
                        <tr>
                            <td>Program Study</td>
                            <td>:</td>
                            {{-- <td>{{ $user->study_program_selected()->first()->study_program->name }}</td> --}}
                        </tr>
                    </tbody>
                </table>
                <p>
                    Sehubungan dengan hal tersebut di atas, maka Saudara dimohon melakukan registrasi ulang
                    dengan memenuhi persyaratan administrasi sebagai berikut :
                </p>
                <ol class="ms-3">
                    <li>
                        Melakukan pembayaran uang registrasi dan uang kuliah bulan ke- 1 sebesar
                        <span class="fw-bold">
                            @rupiah(\App\Models\InformationService::re_registration_price()),-
                            ({{ ucwords(Terbilang::make(\App\Models\InformationService::re_registration_price())) }}
                            Rupiah) </span>paling lambat tanggal <span class="fw-bold"> 15 Mei 2022</span> ke Bank BCA
                        No.
                        rekening {{ \App\Models\InformationService::find(1)->account_number }} atas nama Yayasan
                        Universitas AKI
                    </li>
                    <li>Mengupload pas photo berwarna dengan background warna merah ukuran 3 x 4</li>
                    <li>Mengupload bukti pembayaran dari bank</li>
                    <li>
                        Melakukan pendaftaran Unaki Insight melalui web
                        <span class="text-primary"> unakiinsght.unaki.ac.id</span>
                    </li>
                </ol>
                <p>Demikian pemberitahuan ini disampaikan, selamat bergabung dengan Universitas AKI.</p>
                <div class="ttd">
                    <p>Semarang, {{ date('d-m-Y', strtotime($user->certificate_receive->created_at)) }}</p>
                    <p>Panitia Penerimaan Mahasiswa Baru</p>
                    <p class="nama">Fania Puspa Andiani, S.E</p>
                </div>
            </div>
        </div>
        <div class="details">
            <h4>RINCIAN BIAYA KULIAH</h4>
            <p>1. Angsuran Bulan Ke - 1 dan Uang Registrasi</p>
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <thead class="">
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Pembayaran Uang Pangkal</td>
                            <td>@rupiah($user->certificate_receive->user_initial_payment->nominal)</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Iuran Kesehatan</td>
                            <td>@rupiah($user->certificate_receive->health_payment->nominal)</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Iuran Kemahasiswaan</td>
                            <td>@rupiah($user->certificate_receive->kemahasiswaan_contribution->nominal)</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Iuran Perpustakaan</td>
                            <td>@rupiah($user->certificate_receive->library_contribution->nominal)</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Biaya E-Materai</td>
                            <td>@rupiah(\App\Models\InformationService::find(1)->ematerai)</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Potongan Harga</td>
                            <td>@rupiah(@$user->certificate_receive?->discount?->nominal ?? 0)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Total Pembayaran</td>
                            <td>@rupiah($user->certificate_receive->getTotalPrice($user->certificate_receive->id))</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- <p>2. Angsuran uang kuliah pada bulan ke - 2 s/d ke - 48, sebesar Rp 540.000,-</p> --}}
            <div class="ms-4">
                <p class="mb-0">Keterangan :</p>
                <ul style="list-style-type: disc">
                    <li>Pada slip pembayaran dicantumkan Nama Mahasiswa, Program Studi dan Alamat Lengkap</li>
                    <li>
                        Pembayaran biaya kuliah pada bulan ke - 2 sampai dengan ke - 48 wajib dibayarkan paling
                        lambat tanggal 15 setiap bulan
                    </li>
                    <li>Keterlambatan pembayaran akan dikenakan denda sebesar 5%</li>
                    <li class="fw-bold">
                        Pembayaran yang sudah dilakukan tidak dapat ditarik kembali dengan alasan apapun
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
