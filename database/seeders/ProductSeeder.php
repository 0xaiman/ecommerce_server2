<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Vanilo\Foundation\Models\Product;
use Vanilo\Foundation\Models\Taxon;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Fresh Navel Oranges (1kg)',
                'price' => 8.50,
                'sku' => 'BN-' . Str::random(6),
                'category' => 'Oranges',
                'description' => 'Juicy and sweet, perfect for juicing or snacking.',
            ],
            [
                'name' => 'Organic Bananas (1kg)',
                'price' => 6.00,
                'sku' => 'BN-' . Str::random(6),
                'category' => 'Organic Bananas',
                'description' => 'Naturally ripened bananas grown without chemicals.',
            ],
            [
                'name' => 'Sweet Honey Mangoes (3 pcs)',
                'price' => 12.00,
                'sku' => 'MN-' . Str::random(6),
                'category' => 'Mangoes',
                'description' => 'Premium mangoes with a rich tropical flavor.',
            ],
            [
                'name' => 'Blueberries (200g pack)',
                'price' => 9.00,
                'sku' => 'BL-' . Str::random(6),
                'category' => 'Blueberries',
                'description' => 'Freshly packed, perfect for smoothies or desserts.',
            ],
            [
                'name' => 'Watermelon (whole)',
                'price' => 15.00,
                'sku' => 'WM-' . Str::random(6),
                'category' => 'Watermelons',
                'description' => 'Large and juicy, ideal for summer hydration.',
            ],
            [
                'name' => 'Dried Mango Slices (250g)',
                'price' => 11.00,
                'sku' => 'DM-' . Str::random(6),
                'category' => 'Dried Mangoes',
                'description' => 'Naturally dried mango with no added sugar.',
            ],
            [
                'name' => 'Imported Green Seedless Grapes (500g)',
                'price' => 13.00,
                'sku' => 'IG-' . Str::random(6),
                'category' => 'Imported Grapes',
                'description' => 'Crisp and sweet grapes imported from Australia.',
            ],
            [
                'name' => 'Local Papaya (1 whole)',
                'price' => 7.50,
                'sku' => 'LP-' . Str::random(6),
                'category' => 'Local Papayas',
                'description' => 'Locally grown papaya, ripe and ready to eat.',
            ],
            [
                'name' => 'Golden Pineapple (Whole)',
                'price' => 6.80,
                'sku' => 'PP-' . Str::random(6),
                'category' => 'Tropical Fruits',
                'description' => 'Sweet and tangy pineapple, rich in vitamin C.',
            ],
            [
                'name' => 'Red Fuji Apples (4 pcs)',
                'price' => 10.50,
                'sku' => 'AF-' . Str::random(6),
                'category' => 'Apples',
                'description' => 'Crisp, juicy apples with a natural red blush.',
            ],
            [
                'name' => 'Rambutan (500g)',
                'price' => 8.20,
                'sku' => 'RM-' . Str::random(6),
                'category' => 'Tropical Fruits',
                'description' => 'Exotic hairy fruit with a sweet, lychee-like flesh.',
            ],
            [
                'name' => 'Green Guava (2 pcs)',
                'price' => 5.50,
                'sku' => 'GV-' . Str::random(6),
                'category' => 'Guavas',
                'description' => 'Crisp, tart green guavas, perfect with chili sugar.',
            ],
            [
                'name' => 'Seedless Red Grapes (500g)',
                'price' => 12.30,
                'sku' => 'SG-' . Str::random(6),
                'category' => 'Imported Grapes',
                'description' => 'Sweet red grapes imported from South Africa.',
            ],
            [
                'name' => 'Fresh Dragon Fruit (1 whole)',
                'price' => 9.00,
                'sku' => 'DF-' . Str::random(6),
                'category' => 'Tropical Fruits',
                'description' => 'Bright pink-skinned fruit with refreshing white pulp.',
            ],
            [
                'name' => 'Duku Langsat (1kg)',
                'price' => 6.90,
                'sku' => 'DL-' . Str::random(6),
                'category' => 'Seasonal Fruits',
                'description' => 'Locally grown langsat with sweet, juicy segments.',
            ],
            [
                'name' => 'Frozen Mixed Berries (500g)',
                'price' => 14.00,
                'sku' => 'FB-' . Str::random(6),
                'category' => 'Frozen Fruits',
                'description' => 'Ready-to-use mix of strawberries, blueberries, and raspberries.',
            ],
            [
                'name' => 'Organic Avocados (2 pcs)',
                'price' => 11.50,
                'sku' => 'AV-' . Str::random(6),
                'category' => 'Avocados',
                'description' => 'Rich, creamy organic avocados for salads or smoothies.',
            ],
            [
                'name' => 'Sliced Jackfruit (500g pack)',
                'price' => 8.75,
                'sku' => 'SJ-' . Str::random(6),
                'category' => 'Jackfruit',
                'description' => 'Sweet, fragrant jackfruit cleaned and ready to eat.',
            ],
            [
                'name' => 'Organic Red Apples (1kg)',
                'price' => 10.00,
                'sku' => 'AR-' . Str::random(6),
                'category' => 'Apples',
                'description' => 'Crisp, juicy apples with a natural red blush.',
            ],
            [
                'name' => 'Durian D24 (1kg)',
                'price' => 10.00,
                'sku' => 'DD-' . Str::random(6),
                'category' => 'Durian',
            ],
            [
                'name' => 'Durian Musang King (1kg)',
                'price' => 10.00,
                'sku' => 'DM-' . Str::random(6),
                'category' => 'Durian',
            ]
            
        ];

        foreach ($products as $data) {
            $taxon = Taxon::where('name', $data['category'])->first();

            if (!$taxon) {
                continue; // Skip if category doesn't exist
            }

            $product = Product::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'price' => $data['price'],
                'sku' => $data['sku'],
                'description' => $data['description'],
            ]);

            $product->taxons()->attach($taxon);
        }
    }
}
