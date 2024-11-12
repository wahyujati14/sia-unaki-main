<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicYear>
 */
class AcademicYearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $year = fake()->year();
        return [
            'first_year' => fake()->year(),
            'last_year' => $year+1,
            'odd_even' => fake()->randomDigit() % 2 == 0 ? 'GANJIL' : 'GENAP',
        ];
    }
}
