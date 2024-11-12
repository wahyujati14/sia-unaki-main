<?php

namespace Database\Seeders;

use App\Models\RegistrationPath;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationPathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RegistrationPath::insert([
            [
                'name' => 'Jalur Tes',
                'slug' => 'registration-test',
                'description' => 'registration-non-test'
            ],
            [
                'name' => 'Jalur Non Tes',
                'slug' => 'registration-non-test',
                'description' => 'registration-non-test'
            ],
            [
                'name' => 'Beasiswa Prestasi Akademik',
                'slug' => 'registration-academic',
                'description' => 'registration-academic'
            ],
            [
                'name' => 'Beasiswa Prestasi Non Akademik',
                'slug' => 'registration-non-academic',
                'description' => 'registration-non-academic'
            ],
            [
                'name' => 'Pindahan',
                'slug' => 'registration-transfer',
                'description' => 'registration-transfer'
            ],
            [
                'name' => 'KIP Kuliah',
                'slug' => 'registration-kip',
                'description' => 'registration-kip'
            ],
        ]);
    }
}
