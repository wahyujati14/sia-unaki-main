<?php

namespace Database\Factories;

use App\Models\ClassCourse;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduleClassCourse>
 */
class ScheduleClassCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'class_course_id' => ClassCourse::query()->inRandomOrder()->first()->id,
            'days' => fake()->numberBetween(1, 6),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'room_id' => Room::first()->id, 
        ];
    }
}
