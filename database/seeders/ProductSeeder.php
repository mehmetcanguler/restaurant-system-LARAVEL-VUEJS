<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            'Kahve' => 1, 'Çay' => 1, 'Nescafe' => 1,
            'Ice Tea' => 2, 'MilkShake' => 2, 'Ayran' => 2,
            'Pizza' => 3, 'Döner' => 3, 'Patates Kızartma' => 3,
            'Tavuk Burger' => 4, 'Cheese Burger' => 4, 'Et Burger' => 4
        ];
        foreach ($products as $title=>$category_id) {
            Product::create([
                'category_id'=> $category_id,
                'title' => $title,
                'price' => rand(5,50)
            ]);
        }
    }
}
