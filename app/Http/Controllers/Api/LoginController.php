<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Repo\ApiResponseTrait;

class LoginController extends Controller
{
    use ApiResponseTrait;
    //api login
    public function login(Request $request)
    {

        if (!empty($user = User::whereEmail($request->email)->first()) && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('API TOKEN')->plainTextToken;

            return $this->success([
                'user' => $user->toArray(),
                'token' => $token,
            ], 'Successfully logged in.');
        }

        return $this->warning('Incorrect email or password');
    }
    public function register(RegistrationRequest   $request) : JsonResponse
    {
        User::findOrFail(130);
        $user = User::create(
            ['name'=> $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => User::TYPE['customer'],
            'password'=> Hash::make($request->password)
            ]
        );
        
        return response()->json($user->fresh(),"registered");
    }
    public function resetPassword()
    {}
}
