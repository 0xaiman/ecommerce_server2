<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Vanilo\Product\Models\Product;
use Vanilo\Product\Models\ProductStateProxy;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Create 20 dummy products
        for ($i = 1; $i <= 20; $i++) {
            $name        = ucfirst(implode(' ', $faker->words(3)));
            $slug        = Str::slug($name) . '-' . Str::random(5);
            $sku         = strtoupper('SKU-' . $faker->bothify('??###'));
            $price       = $faker->randomFloat(2, 5, 500);
            $original    = $faker->boolean(50) ? $faker->randomFloat(2, $price + 1, 600) : null;
            $excerpt     = $faker->optional()->sentence(8);
            $description = $faker->optional()->paragraph(3);
            $state       = ProductStateProxy::defaultValue();
            $extTitle    = $faker->optional()->sentence(6);
            $metaKeys    = $faker->optional()->words(5, true);
            $metaDesc    = $faker->optional()->sentence(12);
            $stock       = $faker->randomFloat(2, 0, 100);
            $weight      = $faker->optional()->randomFloat(2, 0.1, 10);
            $height      = $faker->optional()->randomFloat(2, 0.1, 50);
            $width       = $faker->optional()->randomFloat(2, 0.1, 50);
            $length      = $faker->optional()->randomFloat(2, 0.1, 50);
            $backorder   = $faker->optional()->randomFloat(2, 0, 30);

            Product::create([
                'name'             => $name,
                'slug'             => $slug,
                'sku'              => $sku,
                'price'            => $price,
                'original_price'   => $original,
                'excerpt'          => $excerpt,
                'description'      => $description,
                'state'            => $state,
                'ext_title'        => $extTitle,
                'meta_keywords'    => $metaKeys,
                'meta_description' => $metaDesc,
                'stock'            => $stock,
                'weight'           => $weight,
                'height'           => $height,
                'width'            => $width,
                'length'           => $length,
                'backorder'        => $backorder,
            ]);
        }
    }
}
