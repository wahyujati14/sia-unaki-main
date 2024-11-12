<?php

namespace Database\Factories;

use App\Models\ClassCourse;
use App\Models\Lecturer;
use App\Models\StudyPlanCard;
use App\Models\UserClassCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserClassCourse>
 */
class UserClassCourseFactory extends Factory
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
            'study_plan_card_id' => StudyPlanCard::query()->inRandomOrder()->first()->id,
            'credit_course' => fake()->numberBetween(1, 3),
            'lecturer_id' => Lecturer::query()->inRandomOrder()->first()->id,
            'status' => UserClassCourse::WAITING,
        ];
    }
}
