<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Дрилі', 'slug' => 'drills'],
            ['name' => 'Шуруповерти', 'slug' => 'screwdrivers'],
            ['name' => 'Болгарки (кутові шліфмашини)', 'slug' => 'grinders'],
            ['name' => 'Перфоратори', 'slug' => 'hammers'],
            ['name' => 'Електропили', 'slug' => 'saws'],
            ['name' => 'Інший інструмент', 'slug' => 'other'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
