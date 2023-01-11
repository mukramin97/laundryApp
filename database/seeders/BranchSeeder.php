<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $now = Carbon::now();

        for($i = 1; $i <= 10; $i++){
    		DB::table('branchs')->insert([

                'branch_name' => $faker->name,
                'phone_number' => $faker->phoneNumber,
                'created_at' => $now,
                'updated_at' => $now,

    		]);
    	}
    }
}
