<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function registerAdmin(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'telephone' => 'required|string|unique:admins',
            'email' => 'required|string|email|unique:admins',
            'password' => 'required|string|min:6'
        ]);

        if (!empty($request->img)) {
            $file = $request->file('img');
            $img = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/profile/admins-image/'), $img);
            $data['img'] = 'images/profile/admins-image/' . $img;
            $img = 'images/profile/admins-image/' . $img;
        } else {
            $img = null;
        }

        $admin = Admin::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'img' => $img,
            'telephone' => $validatedData['telephone'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user_id = Admin::find($admin->id);
        $user = User::create([
            'user_id' => $user_id->id,
            'email' => $user_id->email,
            'password' => $user_id->password,
            'role_id' => 1
        ]);

        $message = "Admin is created";
        return $this->sendResponse($admin, $message);
    }

    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (!Auth::guard('admin')->attempt($credentials)) {
            return $this->sendError('Please check your e-mail and password.');
        }

        $admin = $request->user('admin');

        $apiToken = $admin->createToken('api_token')->plainTextToken;
        $admin->setAttribute('api_token', $apiToken);
        $admin->save();

        $message = "Admin is logged in successfully";
        return $this->sendResponse($admin, $message);
    }







}
