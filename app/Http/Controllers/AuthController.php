<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
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
    private $userRepository;

    /**
     * AuthController constructor.
     * @param Request $request
     * @param UserRepository $userRepository
     */
    public function __construct(Request $request, UserRepository $userRepository)
    {
        $this->request = $request;
        $this->userRepository = $userRepository;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        try
        {
            $check_user = User::where('email', $this->request->email)->first();
            if($check_user)
            {
                return response()->json(['error' => 'A user with email {' . $this->request->email . '} already exist'], 400);
            }

            $user = $this->userRepository->create($this->request);
            return response()->json($user, 201);
        }
        catch(\Exception$ex)
        {
            return response()->json(['error' => $ex->getMessage()], 400);
        }
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