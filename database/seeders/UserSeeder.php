<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(29)->create();

        User::create([
            'name' => 'Intriga',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
