<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlatformLink;
class PlatformLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
    {
        return view('user.platformlink.list');

    }
        public function store(Request $request)
        {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'company_name' => 'required|string|max:255',
                'company_link' => 'required|url',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming logo is an image file
                'email' => 'nullable|email', // Validate email field
                'password' => 'nullable|string|min:6', // Validate password field
            ]);

            // Upload logo file
            $logoPath = $request->file('logo')->store('logos'); // Store the logo file in the 'logos' directory

            // Create a new PlatformLink instance and save it to the database
            $platformLink = new PlatformLink();
            $platformLink->user_id = auth()->id(); // Assuming you're storing the user ID
            $platformLink->company_name = $validatedData['company_name'];
            $platformLink->company_link = $validatedData['company_link'];
            $platformLink->email = $validatedData['email']; // Store email if provided
            $platformLink->password = $validatedData['password']; // Store password if provided
            $platformLink->logo = $logoPath; // Store the path to the uploaded logo file
            $platformLink->save();

            flashy()->success('Platform link Created Successfully');
            return redirect()->route('user.platformlink.list')->with('success', 'Platform link added successfully.');
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
    public function update(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'platform_id' => 'required|exists:platform_links,id',
        'email' => 'nullable|email', // Validate email field
        'password' => 'nullable|string|min:6', // Validate password field
    ]);

    // Find the platform link by ID
    $platformLink = PlatformLink::findOrFail($validatedData['platform_id']);

    // Update email and password fields if provided
    if (isset($validatedData['email'])) {
        $platformLink->email = $validatedData['email'];
    }
    if (isset($validatedData['password'])) {
        $platformLink->password = $validatedData['password'];
    }

    // Save the changes
    $platformLink->save();

    flashy()->success('Platform link Updated Successfully');
    return redirect()->route('user.platformlink.list')->with('success', 'Platform link updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
