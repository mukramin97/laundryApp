<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert([

            'category_name' => 'Hemat 1',
            'description' => 'Mencuci hingga kering, setrika, dan selesai dalam waktu 1 hari',
            'price' => 4000,

        ]);

        DB::table('categories')->insert([

            'category_name' => 'Hemat 2',
            'description' => 'Mencuci hingga kering, setrika, dan selesai dalam waktu 2 hari',
            'price' => 5000,

        ]);

        DB::table('categories')->insert([

            'category_name' => 'Express 3',
            'description' => 'Mencuci hingga kering, setrika, dan selesai dalam waktu 3 jam',
            'price' => 10000,

        ]);

        DB::table('categories')->insert([

            'category_name' => 'Express 12',
            'description' => 'Mencuci hingga kering, setrika, dan selesai dalam waktu 6 jam',
            'price' => 8000,

        ]);

    }
}
