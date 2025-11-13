<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Дрилі (category_id = 1)
            ['name' => 'Дриль Bosch GSB 13', 'description' => 'Потужна ударна дриль для побутових задач.', 'price' => 1899, 'category_id' => 1, 'image' => 'drill1.jpg'],
            ['name' => 'Дриль Makita HP1640', 'description' => 'Якісна японська ударна дриль.', 'price' => 2499, 'category_id' => 1, 'image' => 'drill2.jpg'],

            // Шуруповерти (category_id = 2)
            ['name' => 'Шуруповерт DeWALT DCD776', 'description' => 'Акумуляторний шуруповерт 18V.', 'price' => 3499, 'category_id' => 2, 'image' => 'screw1.jpg'],
            ['name' => 'Шуруповерт Makita DF457DWE', 'description' => 'Надійний побутовий шуруповерт.', 'price' => 2899, 'category_id' => 2, 'image' => 'screw2.jpg'],
            ['name' => 'Шуруповерт Bosch GSR 120', 'description' => 'Компактний та легкий шуруповерт.', 'price' => 2599, 'category_id' => 2, 'image' => 'screw3.jpg'],

            // Болгарки (category_id = 3)
            ['name' => 'Болгарка Bosch GWS 750', 'description' => 'Професійна кутова шліфмашина.', 'price' => 1999, 'category_id' => 3, 'image' => 'grinder1.jpg'],
            ['name' => 'Болгарка Makita GA5030', 'description' => 'Популярна болгарка 125 мм.', 'price' => 1599, 'category_id' => 3, 'image' => 'grinder2.jpg'],

            // Перфоратори (category_id = 4)
            ['name' => 'Перфоратор Bosch GBH 2-26', 'description' => 'Молотковий перфоратор для ремонту.', 'price' => 4699, 'category_id' => 4, 'image' => 'hammer1.jpg'],
            ['name' => 'Перфоратор Makita HR2470', 'description' => 'Один із найкращих перфораторів.', 'price' => 4499, 'category_id' => 4, 'image' => 'hammer2.jpg'],

            // Електропили (category_id = 5)
            ['name' => 'Електропила Stihl MSE 170', 'description' => 'Надійна електропила для дому.', 'price' => 3999, 'category_id' => 5, 'image' => 'saw1.jpg'],
            ['name' => 'Електропила Makita UC3541A', 'description' => 'Відомий якісний інструмент.', 'price' => 3299, 'category_id' => 5, 'image' => 'saw2.jpg'],

            // Інше (category_id = 6)
            ['name' => 'Лобзик Bosch PST 700', 'description' => 'Легкий та зручний лобзик.', 'price' => 1999, 'category_id' => 6, 'image' => 'other1.jpg'],
            ['name' => 'Степлер будівельний Stanley TR250', 'description' => 'Алюмінієвий корпус, висока міцність.', 'price' => 699, 'category_id' => 6, 'image' => 'other2.jpg'],
            ['name' => 'Мультитул Leatherman Wingman', 'description' => '18 функцій у одному інструменті.', 'price' => 1799, 'category_id' => 6, 'image' => 'other3.jpg'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
