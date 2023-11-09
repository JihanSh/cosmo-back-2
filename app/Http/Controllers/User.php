<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email|unique:user_auth,email',
                'Password' => 'required|min:8',
                'FirstName' => 'required',
                'LastName' => 'required',
                'Gender' => 'nullable',
                'phone_number' => 'nullable',
                'address' => 'required',
                'apartment' => 'nullable',
                'country' => 'required',
                'city' => 'required',
                'zip_code' => 'required',
            ]);

            $user = new UserModel;

            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->gender = $data['gender'];
            $user->phone_number = $data['phone_number'];
            $user->address = $data['address'];
            $user->apartment = $data['apartment'];
            $user->country = $data['country'];
            $user->city = $data['city'];
            $user->zip_code = $data['zip_code'];

            $user->save();

            return response()->json(['message' => 'Registration successful'], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'errors' => $e->validator->errors()], 422);
        }
    }

    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'Email' => 'required|email',
                'Password' => 'required|min:8',
            ]);

            $credentials = [
                'email' => $data['Email'],
                'password' => $data['Password'],
            ];

            if (auth('user_auth')->attempt($credentials)) {
                $user = auth('user_auth')->user();
                return response()->json(['message' => 'Login successful', 'user' => $user], 200);
            }

            return response()->json(['error' => 'Invalid login credentials'], 401);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'errors' => $e->validator->errors()], 422);
        }
    }

    public function getUserById($id)
    {
        $user = UserModel::find($id);

        if ($user) {
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
    public function getAllUsers()
    {
        $users = UserModel::all();

        return response()->json(['users' => $users], 200);
    }

    public function updateUser(Request $request, $id)
    {
        $user = UserModel::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $data = $request->validate([
            'Email' => 'required|email|unique:user_auth,Email',
            'Password' => 'min:8',
            'FirstName' => 'required',
            'LastName' => 'required',
            'gender' => 'nullable',
            'phone_number' => 'nullable',
            'address' => 'required',
            'apartment' => 'nullable',
            'country' => 'required',
            'region' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
        ]);

        $user->update($data);

        return response()->json(['message' => 'User updated successfully'], 200);
    }

    public function deleteUser($id)
    {
        $user = UserModel::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
