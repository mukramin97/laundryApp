<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 100; $i++){

            $dateThisMonth = $faker->dateTimeThisMonth();
            $dateThisMonth_ = Carbon::parse($dateThisMonth)->addDay();

    		DB::table('orders')->insert([
                'name' => $faker->name,
                'item' => $faker->randomElement(['Pakaian', 'Sprei', 'Jas']),
                'weight' => $faker->randomFloat(2, 2, 10),
                'status' => $faker->randomElement(['Proses','Menunggu', 'Selesai']),
                'branch_id' => $faker->numberBetween(1, 5),
                'category_id' => $faker->numberBetween(1, 3),
                'user_id' => $faker->numberBetween(1, 20),
                'date_placed' => $dateThisMonth,
                'date_completed' => $faker->randomElement([$dateThisMonth_, null]),
    		]);
    	}

    }
}
