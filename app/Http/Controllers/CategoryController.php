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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('recipes.addCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => 'required'
        ]);
    
        // Check if a category with the same name already exists
        $categoryWithSameName = Category::where('name', $request->input('categoryName'))->first();
    
        if ($categoryWithSameName) {
            return redirect()->route('add-category')->with('danger', 'A category with the same name already exists.');
        }
    
        // Create a new category if it doesn't already exist
        Category::create([
            'name' => $request->input('categoryName')
        ]);

        $categories = Category::all();
        $success = true;
        return redirect()->route('showForm')->with(['categories' => $categories]);

    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
