<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);
        $validated['slug']=Str::slug($validated['name'], '-');
        Category::create($validated);
        return back();
    }
}
