<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\User;
class CustomerController extends ApiController
{
    public function registerCustomer(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'telephone' => 'required|string|max:15',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
            'identity_number' => 'required|string|digits:11',
            'mother_name' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female',
            'place_of_birth' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        if (!empty($request->img)) {
            $file = $request->file('img');
            $img = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/profile/customer-image/'), $img);
            $data['img'] = 'images/profile/customer-image/' . $img;
            $img = 'images/profile/customer-image/' . $img;
        } else {
            $img = null;
        }

        $customer = Customer::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'img' => $img,
            'telephone' => $validatedData['telephone'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'identity_number' => $validatedData['identity_number'],
            'mother_name' => $validatedData['mother_name'],
            'father_name' => $validatedData['father_name'],
            'gender' => $validatedData['gender'],
            'place_of_birth' => $validatedData['place_of_birth'],
            'birth_date' => $validatedData['birth_date'],
            'address' => $validatedData['address'],
        ]);

        $user_id = Customer::find($customer->id);
        $user = User::create([
            'user_id' => $user_id->id,
            'email' => $user_id->email,
            'password' => $user_id->password,
            'role_id' => 3
        ]);


        $message = "Customer is created";
        return $this->sendResponse($customer, $message);
    }

    
}
