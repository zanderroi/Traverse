<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('avatar')) {

        // Save the avatar in the database
        $avatar = new Avatar();
        $avatar->avatar = $request->file('avatar')->store('public/avatar');
        $avatar->user_id = Auth::user()->id;
        $avatar->save();

        // Show success message and redirect to the profile page
        return redirect()->route('customer.profile')->with('success', 'Avatar uploaded successfully!');
    }

    // If no file was uploaded, show an error message
    return redirect()->route('customer.profile')->with('error', 'No avatar file was uploaded.');
}

    
}
