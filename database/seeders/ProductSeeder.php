<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $products = [
            [ 'id' => '1', 'name' => 'Burger', 'available_stock' => '5' ],
            [ 'id' => '2', 'name' => 'Pizza', 'available_stock' => '10' ],
            [ 'id' => '3', 'name' => 'Fries', 'available_stock' => '15' ],
        ];

        Product::insert($products);
    }
}
