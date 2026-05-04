<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();   
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=> '  required|string|min:3|max:100'
        ]);

        return Category::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $category;
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $resCategory = $category;

        $category->delete();

        return [
            'message'=>'categoria eliminada',
            'data'=>$resCategory
            ];
    }
}
