<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassCourse>
 */
class ClassCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'course_id' => Course::query()->inRandomOrder()->first()->id,
            'lecturer_id' => Lecturer::query()->inRandomOrder()->first()->id,
            'code' => fake()->ean8(),
            'credit_course' => fake()->randomNumber(),
            'credit_course_hourly' => fake()->randomNumber(),
            'credit_course_payment' => fake()->randomNumber(),
            'note' => '-',
            'semester' => fake()->randomNumber(),
            'presence_qrcode' => fake()->ean13(),
        ];
    }
}
