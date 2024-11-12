<?php

namespace Database\Seeders;

use App\Models\StudyPlanCard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyPlanCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudyPlanCard::factory(3)->create();
    }
}
