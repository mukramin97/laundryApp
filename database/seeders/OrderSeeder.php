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

        for($i = 1; $i <= 300; $i++){

            $dateThisMonth = $faker->dateTimeThisMonth();
            $dateThisMonth_ = Carbon::parse($dateThisMonth)->addDay();
            $dateCompleted = $faker->randomElement([$dateThisMonth_, null]);
            $user_id = $faker->numberBetween(1, 20);

            if($dateCompleted){
                $status = 'Selesai';
            }
            else if($dateCompleted == null){
                $status = $faker->randomElement(['Proses','Menunggu']);
            };

    		$order_id = DB::table('orders')->insertGetId([
                'name' => $faker->firstName(),
                'item' => $faker->randomElement(['Pakaian', 'Sprei', 'Jas']),
                'weight' => $faker->randomFloat(1, 2, 10),
                'status' => $status,
                'branch_id' => $faker->numberBetween(1, 5),
                'category_id' => $faker->numberBetween(1, 3),
                'user_id' => $user_id,
                'date_placed' => $dateThisMonth,
                'date_completed' => $dateCompleted,
    		]);

            if($dateCompleted){
                DB::table('payments')->insert([
                    'cost' => $faker->randomNumber(5, true),
                    'amount_paid' => $faker->randomNumber(5, true),
                    'date_payment' => $dateCompleted,
                    'user_id' => $user_id,
                    'order_id' => $order_id,
                ]);
            }
    	}

    }
}
