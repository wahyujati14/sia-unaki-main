<?php

namespace Database\Seeders;

use App\Models\InformationSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformationSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InformationSource::insert([
            [ "name" => "Alumni UNAKI"],
            [ "name" => "Teman / Keluarga"],
            [ "name" => "Facebook"],
            [ "name" => "Instagram"],
            [ "name" => "Website UNAKI"],
            [ "name" => "Google / Aplikasi Pencarian Lain"],
            [ "name" => "Kunjungan UNAKI Ke Sekolah"],
            [ "name" => "Brosur / Pamflet"],
            [ "name" => "Baliho"],
            [ "name" => "Lainnya"],
        ]);
    }
}
