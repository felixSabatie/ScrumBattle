<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'avatar' => ['required', 'string']
        ]);
    }

    protected function register(Request $request)
    {
        $validator = $this->validator($request->all());
        if(!$validator->fails()) {
            return response()->json(['status' => 422]);
        }
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'avatar' => $request['avatar']
        ]);

        return response()->json(['status' => 201]);
    }
}
