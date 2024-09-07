<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [];

        for ($i=0; $i < 50; $i++) {
            array_push($products, [
                'name' => fake()->name(),
                'description' => fake()->text(100),
                'price' => fake()->randomFloat(2, 30, 1000),
                'stock' => fake()->numberBetween(0, 100),
                'image'=> fake()->image(config('filesystems.disks.public.root'), 640, 480, null, false),
            ]);
        }

        Product::query()->insert($products);
    }
}
