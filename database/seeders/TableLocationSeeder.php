<?php

namespace Database\Seeders;

use App\Models\TableLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableLocation = ['Balkon'=>'blue','Zemin Kat'=>'gray','Bahçe'=>'green'];
        foreach ($tableLocation as $value=>$color )
        {
            TableLocation::create([
                'title' => $value,
                'color' => $color
            ]);
        }
       
    }
}
