<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Saloon>
 */
class SaloonFactory extends Factory
{
    protected static array $logos = [
        'storage/test-media/logo-example-1.png',
        'storage/test-media/logo-example-2.png',
        'storage/test-media/logo-example-3.png',
        'storage/test-media/logo-example-4.png',
        'storage/test-media/logo-example-5.png',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'descr' => fake()->text(1000),
            'logo' => static::$logos[array_rand(static::$logos)],
            'socials' => fake()->url(),
        ];
    }
}
