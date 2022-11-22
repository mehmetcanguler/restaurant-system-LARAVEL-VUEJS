<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'mcg@mcg.com',
            'name'=>'mcg',
            'password' => 'mcg',
            'role' => 1,
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
