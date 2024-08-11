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
        $photos = [];
        for ($i = 0; $i < 11; $i++) {
            $photos[] = 'storage/test_images/loc-photo-example-'.($i+1).'.jpg';
        }

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
            'gen' => fake()->boolean(),
            'photos' => $this->photos(),
            'video' => null
        ];
    }
}
