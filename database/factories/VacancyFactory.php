<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    protected static array $jobs = ['Бариста', 'Старший Бариста'];

    protected static array $employments = ['Повна', 'Не повна', 'Виходжу на підміни'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job' => static::$jobs[array_rand(static::$jobs)],
            'employment' => static::$employments[array_rand(static::$employments)],
            'experience' => fake()->numberBetween(0, 6),
            'salary' => round(fake()->numberBetween(10000, 100000), -2),
            'descr' => fake()->text(1000)
        ];
    }
}
