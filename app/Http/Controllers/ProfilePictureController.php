<?php

namespace App\Http\Controllers;

use App\Models\ProfilePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfilePictureController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'profilepicture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
            $profilepicture = new ProfilePicture();
            $profilepicture->profilepicture = $request->file('profilepicture')->store('public/profilepicture');
            $profilepicture->user_id = Auth::user()->id;
            $profilepicture->save();
    
            return redirect()->route('customer.profile')->with('success', 'Profile Picture uploaded successfully!');
        
    
    }
    
    

    
}
