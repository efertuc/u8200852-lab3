<?php

namespace Database\Seeders;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SkladFactory::new()->count(10)->create()->each(function ($sklad) {
            $sklad->products()->saveMany(ProductFactory::new()->count(random_int(1,15))->make());
        });
    }
}
