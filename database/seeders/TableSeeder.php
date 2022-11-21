<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($table_location = 1; $table_location < 4; $table_location++) {
            for ($table_no = 1; $table_no < 11; $table_no++) {
                Table::create([
                    'table_location_id' => $table_location,
                    'table_no' => $table_no
                ]);
            }
        }
    }
}
