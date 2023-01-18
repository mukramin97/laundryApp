<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Admin.123'),
            'remember_token' => Str::random(60),
            'branch_id' => 1,
            'is_superadmin' => true,
        ]);

        for($i = 1; $i <= 20; $i++){

    		DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('Admin.123'),
                'remember_token' => Str::random(60),
                'branch_id' => $faker->randomElement([1, 2, 3, 4, 5]),
    		]);
    	}
    }
}
