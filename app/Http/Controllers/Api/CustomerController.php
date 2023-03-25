<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function registerCustomer(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'telephone' => 'required|string|max:15|unique:employee',
            'email' => 'required|string|email|unique:employee',
            'password' => 'required|string|min:6',
            'mother_name' => 'nullable|stringmax:255',
            'father_name' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female',
            'place_of_birth' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        $customer = Customer::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'telephone' => $validatedData['telephone'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'mother_name' => $validatedData['mother_name'],
            'father_name' => $validatedData['father_name'],
            'gender' => $validatedData['gender'],
            'place_of_birth' => $validatedData['place_of_birth'],
            'birth_date' => $validatedData['birth_date'],
            'address' => $validatedData['address'],
        ]);

        //$token = $user->createToken('authToken')->plainTextToken;

        $message = "Customer is created";
        return $this->sendResponse($customer,$message);

    }
}
