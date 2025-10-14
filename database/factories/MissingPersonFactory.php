<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MissingPersonFactory extends Factory
{
    public function definition(): array
    {
        $firstNames = ['Іван', 'Марія', 'Петро', 'Олена', 'Олексій', 'Наталія'];
        $lastNames = ['Іваненко', 'Петренко', 'Сидоренко', 'Коваленко', 'Бондаренко'];

        return [
            'user_id' => User::factory(),
            'first_name' => $this->faker->randomElement($firstNames),
            'last_name' => $this->faker->randomElement($lastNames),
            'middle_name' => $this->faker->optional()->firstName(),
            'age' => $this->faker->numberBetween(5, 85),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'description' => $this->faker->paragraph(3),
            'special_marks' => $this->faker->optional(0.3)->sentence(),
            'disappeared_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => 'missing',
            'contact_info' => '+380' . $this->faker->numerify('#########'),
            'is_urgent' => $this->faker->boolean(20),
        ];
    }
}
