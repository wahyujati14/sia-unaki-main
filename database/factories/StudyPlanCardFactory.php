<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\StudyPlanCard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudyPlanCard>
 */
class StudyPlanCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'academic_year_id' => AcademicYear::query()->inRandomOrder()->first()->id,
            'note' => '-',
            'status' => StudyPlanCard::STATUS_WAITING,
        ];
    }
}
