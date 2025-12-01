<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            // CATEGORY: Snacks
            [
                'category' => 'Snacks',
                'name' => 'Chippy BBQ',
                'description' => 'Classic Filipino barbecue-flavored corn snack.',
                'price' => 34.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category' => 'Snacks',
                'name' => 'Nova Cheese',
                'description' => 'Cheese-flavored crunchy corn snacks.',
                'price' => 28.50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // CATEGORY: Drinks
            [
                'category' => 'Drinks',
                'name' => 'Coca-Cola 500ml',
                'description' => 'Refreshing soft drink 500ml bottle.',
                'price' => 35.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category' => 'Drinks',
                'name' => 'Royal Orange 330ml',
                'description' => 'Sweet orange-flavored soda drink.',
                'price' => 25.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
