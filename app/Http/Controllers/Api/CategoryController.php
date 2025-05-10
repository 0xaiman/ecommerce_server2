<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Vanilo\Category\Models\Taxonomy;
use Vanilo\Foundation\Models\Taxon;

class CategoryController extends Controller
{
    public function index(Request $request)
    {        
        $taxonomy = Taxonomy::where('name', 'category')->firstOrFail();
        $categories = Taxon::where('taxonomy_id', $taxonomy->id)->get();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $taxonomy = Taxonomy::where('name', 'category')->firstOrFail();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:taxons,slug',
            'parent_id' => 'nullable|exists:taxons,id',
        ]);

        $category = Taxon::create([
            'name' => $data['name'],
            'slug' => $data['slug'] ?? Str::slug($data['name']),
            'taxonomy_id' => $taxonomy->id,
            'parent_id' => $data['parent_id'] ?? null,
        ]);

        return response()->json($category, 201);
    }

    public function show($id)
    {
        $taxonomy = Taxonomy::where('name', 'category')->firstOrFail();
        $category = Taxon::where('taxonomy_id', $taxonomy->id)->findOrFail($id);
        return response()->json($category);
    }   

    public function update(Request $request, $id)
    {
        $taxonomy = Taxonomy::where('name', 'category')->firstOrFail();
        $category = Taxon::where('taxonomy_id', $taxonomy->id)->findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:taxons,slug,' . $id,
            'parent_id' => 'nullable|exists:taxons,id', 
        ]);

        $category->update($data);

        return response()->json($category);
    }

    public function destroy($id)
    {
        $taxonomy = Taxonomy::where('name', 'category')->firstOrFail();
        $category = Taxon::where('taxonomy_id', $taxonomy->id)->findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 204);
    }
}
