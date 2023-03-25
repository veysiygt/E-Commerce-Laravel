<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function registerAdmin(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'telephone' => 'required|string|unique:admins',
            'email' => 'required|string|email|unique:admins',
            'password' => 'required|string|min:6',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $admin = Admin::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'telephone' => $validatedData['telephone'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $img = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/profile/admins-image/'), $img);
            $data['image'] = 'images/profile/admins-image/' . $img;
            $file_path = public_path($data['image']);
        } else {
            $img = null;
            $file_path = null;
        }

        $message = "Admin is created";
        return $this->sendResponse($admin,$message,$file_path);

    }

}
