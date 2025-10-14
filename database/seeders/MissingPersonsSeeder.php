<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use App\Models\MissingPerson;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MissingPersonsSeeder extends Seeder
{
    public function run(): void
    {
        // Створюємо тестового користувача
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Адміністратор',
                'email' => 'admin@missingpersons.com',
                'password' => Hash::make('password'),
            ]);
        }

        // Створюємо категорії
        $categories = [
            ['name' => 'Діти', 'slug' => 'children', 'description' => 'Зниклі діти до 18 років'],
            ['name' => 'Дорослі', 'slug' => 'adults', 'description' => 'Зниклі дорослі 18-60 років'],
            ['name' => 'Літні люди', 'slug' => 'elderly', 'description' => 'Зниклі люди похилого віку'],
            ['name' => 'Особи з інвалідністю', 'slug' => 'disabled', 'description' => 'Особи з особливими потребами'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Створюємо локації
        $locations = Location::factory(10)->create();

        // Створюємо зниклих осіб
        $missingPeople = MissingPerson::factory(15)->create([
            'user_id' => $user->id,
            'last_location_id' => function() use ($locations) {
                return $locations->random()->id;
            },
        ]);

        // Додаємо категорії до зниклих осіб
        foreach ($missingPeople as $person) {
            $person->categories()->attach(
                Category::inRandomOrder()->limit(rand(1, 2))->pluck('id')
            );
        }

        // Створюємо звіти про появи
        foreach ($missingPeople as $person) {
            Report::factory(rand(0, 3))->create([
                'missing_person_id' => $person->id,
                'user_id' => $user->id,
                'sighting_location_id' => $locations->random()->id,
            ]);
        }

        $this->command->info('✅ Тестові дані створені успішно!');
        $this->command->info('👤 Користувач: admin@missingpersons.com / password');
        $this->command->info('📊 Створено: ' . $missingPeople->count() . ' зниклих осіб');
        $this->command->info('📝 Створено: ' . Report::count() . ' звітів');
    }
}
