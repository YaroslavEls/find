<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    protected function photos(): string
    {
        $photos = [
            'uploads/loc-photo-example-1.jpg',
            'uploads/loc-photo-example-2.jpg',
            'uploads/loc-photo-example-3.jpg',
            'uploads/loc-photo-example-4.jpg',
            'uploads/loc-photo-example-5.jpg',
            'uploads/loc-photo-example-6.jpg',
            'uploads/loc-photo-example-7.jpg',
            'uploads/loc-photo-example-8.jpg',
            'uploads/loc-photo-example-9.jpg',
            'uploads/loc-photo-example-10.jpg',
            'uploads/loc-photo-example-11.jpg',
        ];

        $randomKeys = array_rand($photos, 5);

        $randomElements = [];
        foreach ($randomKeys as $key) {
            $randomElements[] = $photos[$key];
        }

        return implode(';', $randomElements);
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'city' => fake()->city(),
            'address' => fake()->streetAddress(),
            'schedule' => '07:00 - 20:00',
            'photos' => $this->photos(),
            'video' => null
        ];
    }
}
