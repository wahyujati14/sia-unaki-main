<?php

namespace Database\Factories;

use App\Models\AcademicDegree;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecturer>
 */
class LecturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'code' => fake()->ean13(),
            'number' => fake()->ean13(),
            'study_program_id' => StudyProgram::query()->inRandomOrder()->first()->id,
            'academic_degree' => fake()->jobTitle(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'certificate_sign' => fake()->ean13(),
            'status' => Lecturer::STATUS_ACTIVE,
            'password' => Hash::make('123456'),
        ];
    }
}
