<?php

namespace Database\Seeders;

use App\Models\ScheduleClassCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleClassCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ScheduleClassCourse::factory(3)->create();
    }
}
