<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        // Sample data for demonstration. You can replace this with real data from your database.
        $managers = [
            ['name' => 'John Doe', 'designation' => 'Content Manager','email' => 'john.doe@example.com', 'image' => 'https://via.placeholder.com/100'],
            ['name' => 'Jane Smith', 'designation' => 'Content Manager', 'email' => 'jane.smith@example.com', 'image' => 'https://via.placeholder.com/100'],
            ['name' => 'Michael Brown', 'designation' => 'Content Manager', 'email' => 'michael.brown@example.com', 'image' => 'https://via.placeholder.com/100'],
            ['name' => 'Emily White', 'designation' => 'Content Manager', 'email' => 'emily.white@example.com', 'image' => 'https://via.placeholder.com/100'],
             ['name' => 'John Doe', 'designation' => 'Content Manager','email' => 'john.doe@example.com', 'image' => 'https://via.placeholder.com/100'],
            ['name' => 'Jane Smith', 'designation' => 'Content Manager', 'email' => 'jane.smith@example.com', 'image' => 'https://via.placeholder.com/100'],
            ['name' => 'Michael Brown', 'designation' => 'Content Manager', 'email' => 'michael.brown@example.com', 'image' => 'https://via.placeholder.com/100'],
            ['name' => 'Emily White', 'designation' => 'Content Manager', 'email' => 'emily.white@example.com', 'image' => 'https://via.placeholder.com/100'],
        ];

        return view('user.manager.list', compact('managers'));
    }

    public function create()
    {
        return view('user.manager.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required|string',
        ]);

        // Handle the file upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        }

        // Create the manager (this is just a demonstration, normally you'd save to a database)
        // Manager::create([...]);

        return redirect()->route('managers.index')->with('success', 'Manager created successfully.');
    }
}
