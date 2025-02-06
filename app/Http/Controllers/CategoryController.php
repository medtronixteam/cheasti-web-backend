<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaqCategory;
class CategoryController extends Controller
{
    public function storeCategory(Request $request)
    {
       $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable',
        ]);


        FaqCategory::create($validatedData);

        flashy()->success('Category created successfully.', '');
        return redirect()->back()->with('success', 'Category created successfully.');

    }
}
