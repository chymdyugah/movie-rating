<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use HttpResponses;
    //
    public function register(RegisterRequest $request){
        // $custom_fields = [
        //     'name' => 'required|string',
        //     'email' => 'required|string|unique:users,email',
        //     'password' => 'required|string'
        // ];

        $request->validated($request->all());

        // create user`
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // create token
        $token = $user->createToken('chymdy')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token
        ];

        // return response
        return $this->success($data, 201);
    }

    public function login(LoginRequest $request){
        // $fields = $request->validate([
        //     'email' => 'required|string',
        //     'password' => 'required|string',
        // ]);

        $request->validated($request->all());

        if (!Auth::attempt($request->only(['email', 'password']))){
            return $this->fail("Invalid login", null, 400);
        }

        // try to get user
        $user = User::where('email', $request->email)->first();

        // create token
        $token = $user->createToken('login')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token
        ];

        return $this->success($data, 200);
    }

    // public function logout(Request $request){
    //     auth()->user()->to

    //     return response(
    //         [
    //             'status' => true,
    //             'data' => [],
    //             'message' => 'Unable to log you in'
    //         ], 401
    //     );
    // }
}
