<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //region
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(SubDistrictSeeder::class);
        $this->call(ExamSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(StudyProgramSeeder::class);
        $this->call(RegistrationPathSeeder::class);
        $this->call(InformationSourceSeeder::class);
        $this->call(FileUploadSeeder::class);
        $this->call(InformationServiceSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(PaymentTypeSeeder::class);
    }
}
