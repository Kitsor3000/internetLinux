<?php

namespace Database\Factories;

use App\Models\MissingPerson;
use App\Models\User;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'missing_person_id' => MissingPerson::factory(),
            'user_id' => User::factory(),
            'reporter_name' => $this->faker->name(),
            'reporter_phone' => '+380' . $this->faker->numerify('#########'),
            'sighting_details' => $this->faker->paragraph(3),
            'sighting_location_id' => Location::factory(),
            'sighting_time' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'status' => $this->faker->randomElement(['new', 'verified', 'false_alarm']),
            'admin_notes' => $this->faker->optional(0.4)->paragraph(2),
        ];
    }

    // Додаткові стани фабрики - ВИПРАВЛЕНІ НАЗВИ
    public function newlyCreated()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'new',
            ];
        });
    }

    public function verified()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'verified',
            ];
        });
    }

    public function falseAlarm()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'false_alarm',
            ];
        });
    }

    public function withSpecificPerson($missingPersonId)
    {
        return $this->state(function (array $attributes) use ($missingPersonId) {
            return [
                'missing_person_id' => $missingPersonId,
            ];
        });
    }

    public function withSpecificLocation($locationId)
    {
        return $this->state(function (array $attributes) use ($locationId) {
            return [
                'sighting_location_id' => $locationId,
            ];
        });
    }
}
