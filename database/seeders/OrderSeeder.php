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

        for ($i = 1; $i <= 300; $i++) {

            //Adding random category_id and used it to add to date_completed based on category duration
            $category_id = $faker->numberBetween(1, 4);
            $duration = DB::table('categories')->where('id', $category_id)->value('duration');

            $dateThisMonth = $faker->dateTimeBetween($startDate = '-1 month', $endDate = 'now');
            $dateCompleted = Carbon::parse($dateThisMonth)->addHour($duration);

            //Adding random branch_id and used it to get random user_id based on their each branch
            $branch_id = $faker->numberBetween(1, 5);
            $user_id = DB::table('users')->where('branch_id', $branch_id)->pluck('id');

            $status = $faker->randomElement(['In Progress', 'Completed', 'Collected']);

            $order_id = DB::table('orders')->insertGetId([
                'name' => $faker->firstName(),
                'item' => $faker->randomElement(['Pakaian', 'Sprei', 'Jas']),
                'weight' => $faker->randomFloat(1, 2, 10),
                'status' => $status,
                'branch_id' => $branch_id,
                'category_id' => $category_id,
                'user_id' => $user_id->random(),
                'date_placed' => $dateThisMonth,
                'date_completed' => $dateCompleted,
            ]);

            if ($status == 'Collected') {
                DB::table('payments')->insert([
                    'cost' => $faker->randomNumber(5, true),
                    'amount_paid' => $faker->randomNumber(5, true),
                    'date_payment' => $dateCompleted,
                    'user_id' => $user_id->random(),
                    'order_id' => $order_id,
                ]);
            }
        }
    }
}
