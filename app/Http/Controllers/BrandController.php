<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return Brand::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'website'     => 'nullable|url|max:255',
        ]);

        return Brand::create($validated);
    }

    public function show(Brand $brand)
    {
        return $brand;
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:100',
            'description' => 'nullable|string|max:255',
            'website'     => 'nullable|url|max:255',
        ]);

        $brand->update($validated);

        return $brand;
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->noContent();
    }
}
