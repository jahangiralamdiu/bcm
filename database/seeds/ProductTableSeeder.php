<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([[
            'name' => 'Bricks',
            'product_type_id' => 2,
            'description' => 'Number on bricks'
        ], [
            'name' => 'Labour',
            'product_type_id' => 1,
            'description' => 'Per day labour'
        ]]);
    }
}
