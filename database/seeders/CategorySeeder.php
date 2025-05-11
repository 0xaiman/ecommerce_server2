<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Vanilo\Category\Models\Taxonomy;
use Vanilo\Foundation\Models\Taxon;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Create the root taxonomy
        $taxonomy = Taxonomy::firstOrCreate([
            'name' => 'category',
            'slug' => 'category',
        ]);

        // Fruit-focused category structure
        $categories = [
            'Citrus Fruits' => ['Oranges', 'Mandarins', 'Lemons', 'Limes', 'Grapefruits'],
            'Tropical Fruits' => ['Mangoes', 'Pineapples', 'Bananas', 'Papayas', 'Guavas'],
            'Berries' => ['Strawberries', 'Blueberries', 'Raspberries', 'Blackberries'],
            'Stone Fruits' => ['Peaches', 'Plums', 'Cherries', 'Apricots'],
            'Melons' => ['Watermelons', 'Cantaloupes', 'Honeydew Melons'],
            'Apples & Pears' => ['Red Apples', 'Green Apples', 'Pears'],
            'Organic Fruits' => ['Organic Bananas', 'Organic Apples', 'Organic Citrus'],
            'Local Produce' => ['Local Mangoes', 'Local Papayas', 'Local Bananas'],
            'Imported Fruits' => ['Imported Grapes', 'Imported Kiwis', 'Imported Berries'],
            'Dried Fruits' => ['Dried Mangoes', 'Raisins', 'Dried Dates'],
        ];

        foreach ($categories as $parentName => $children) {
            $parent = Taxon::create([
                'name' => $parentName,
                'slug' => Str::slug($parentName),
                'taxonomy_id' => $taxonomy->id,
            ]);

            foreach ($children as $childName) {
                Taxon::create([
                    'name' => $childName,
                    'slug' => Str::slug($childName),
                    'taxonomy_id' => $taxonomy->id,
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
}
