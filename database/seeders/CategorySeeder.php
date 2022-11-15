<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['sıcak içecek', 'soğuk içecek', 'sıcak yemekler', 'hamburgerler'];
        foreach ($categories as $category) {
            Category::create([
                'title' => $category
            ]);
        }
    }
}
