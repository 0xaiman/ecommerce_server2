<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Vanilo\Category\Models\Taxonomy;
use Vanilo\Foundation\Models\Taxon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Create the root taxonomy
        $taxonomy = Taxonomy::firstOrCreate([
            'name' => 'category',
            'slug' => 'category'
        ]);

        // Top-level categories
        $categories = [
            'Office Supplies' => ['Paper Products', 'Writing Instruments', 'Desk Accessories'],
            'Industrial Equipment' => ['Machinery', 'Safety Gear', 'Tools'],
            'Electronics' => ['Computers', 'Networking', 'Industrial Sensors'],
            'Packaging' => ['Boxes', 'Pallets', 'Tapes'],
            'Cleaning Supplies' => ['Detergents', 'Disinfectants', 'Brooms & Mops'],
            'Automotive' => ['Tires', 'Oil', 'Filters'],
        ];

        foreach ($categories as $parentName => $children) {
            $parent = Taxon::create([
                'name' => $parentName,
                'slug' => \Str::slug($parentName),
                'taxonomy_id' => $taxonomy->id,
            ]);

            foreach ($children as $childName) {
                Taxon::create([
                    'name' => $childName,
                    'slug' => \Str::slug($childName),
                    'taxonomy_id' => $taxonomy->id,
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
}
