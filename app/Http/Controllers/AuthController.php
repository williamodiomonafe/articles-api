<?php

namespace App\Http\Controllers;

use Faker\Provider\Base;
use Validator;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{

    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * AuthController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Assign JWT token payload values
     *
     * @param User $user
     * @return string
     */
    public function jwt(User $user)
    {
        $payload = [
            'iss'   =>  "lumen-jwt", // Issuer of the token
            'sub'   =>  $user->id,  // Subject of the token
            'iat'   =>  time(), // Time when JWT was issued
            'exp'   =>  time() + 60 * 60, // Expiration time
        ];


        return JWT::encode($payload, env('JWT_SECRET'));
    }


    /**
     * Authenticate User and if passed, generate and assign token
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(User $user)
    {
        $this->validate($this->request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Find a user by email
        $user = User::where('email', $this->request->email)->first();

        // If no user is found, throw an error response
        if(!$user)
        {
            return response()->json(['error' => 'Email does not exist.'], 400);
        }

        // Verify user password and generate token
        if(Hash::check($this->request->password, $user->password))
        {
            return response()->json(['token' => $this->jwt($user)], 200);
        }

        // if no return above, therefore Bad Request
        return response()->json(['error' => 'Email or password is wrong'], 400);
    }
}