<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeController extends ApiController
{
    public function registerEmployee(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'telephone' => 'required|string|max:15',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
            'identity_number' => 'nullable|string|digits:11',
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
            $file->move(public_path('images/profile/employee-image/'), $img);
            $data['img'] = 'images/profile/employee-image/' . $img;
            $img = 'images/profile/employee-image/' . $img;
        } else {
            $img = null;
        }

            $employee = Employee::create([
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
        
        $user_id = Employee::find($employee->id);
        $user = User::create([
            'user_id' => $user_id->id,
            'email' => $user_id->email,
            'password' => $user_id->password,
            'role_id' => 2
        ]);

        //$token = $employee->createToken('authToken')->plainTextToken;

        $message = "Employee is created";
        return $this->sendResponse($employee,$message);

    }
}
