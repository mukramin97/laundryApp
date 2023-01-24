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

        for($i = 1; $i <= 5; $i++){

            $dateTime = $faker->dateTimeThisMonth;
            $dateOnly = $dateTime->format('Y-m-d');

    		DB::table('branchs')->insert([

                'branch_name' => $faker->company,
                'phone_number' => $faker->numerify('628#########'),
                'established' => $dateOnly,

    		]);
    	}
    }
}
