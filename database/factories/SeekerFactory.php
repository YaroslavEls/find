<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seeker>
 */
class SeekerFactory extends Factory
{
    protected static array $photos = [
        'uploads/seeker-photo-example-1.jpg',
        'uploads/seeker-photo-example-2.jpg',
        'uploads/seeker-photo-example-3.jpg',
        'uploads/seeker-photo-example-4.jpg',
        'uploads/seeker-photo-example-5.jpg',
    ];

    protected static array $jobs = ['Бариста', 'Старший Бариста'];

    protected static array $employments = ['Повна', 'Неповна', 'Підміни'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'birthday' => fake()->date(),
            'photo' => static::$photos[array_rand(static::$photos)],
            'job' => static::$jobs[array_rand(static::$jobs)],
            'experience' => fake()->numberBetween(0, 6),
            'salary' => round(fake()->numberBetween(10000, 100000), -2),
            'city' => fake()->city(),
            'employment' => static::$employments[array_rand(static::$employments)],
            'info' => fake()->text(1000)
        ];
    }
}
