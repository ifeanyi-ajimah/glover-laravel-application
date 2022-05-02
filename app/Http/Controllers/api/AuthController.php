<?php 

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller 
{

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validdated();
        $verification_token = Str::random(64);

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'type' => "user",
            'verification_token' => $verification_token,
            'password' => Hash::make($data['password']),
        ]);


        $token = $user->createToken('authtoken');
        return response()->json(
            [
                'message'=>'Registration Successful.',
                'data'=> ['token' => $token->plainTextToken, 'user' => $user]
            ]
        );
    }



    public function login(LoginRequest $request)
    {
        
        $login = $request->validated();

        if( !Auth::attempt($login) )
        {
            return response(['error' => 'Invalid login credentials'], 401);
        }

        $token = $request->user()->createToken('authtoken');

        return response()->json(
                   [
                       'message'=>'Logged in successfully',
                       'data'=> [
                           'user'=> $request->user(),
                           'token'=> $token->plainTextToken
                       ]
                   ]
                );

    }


    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response()->json(
            [
                'message' => 'Logged out'
            ]
        );
    }

}






