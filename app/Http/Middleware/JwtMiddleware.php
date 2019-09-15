<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        $token = $request->get('token');

        /**
         * If authentication is not passed or provided and token is thus not supplied
         *
         * @return json
         */
        if(!$token)
        {
            return response()->json([
                'error' => 'Authentication is required then provide token.'
            ], 400);
        }


        /**
         * If authentication is passed and token supplied, then verify token
         *
         * @return response
         */
        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $ex) {
            return response()->json(['error' => 'Provided token is expired'], 400);
        } catch(Exception $ex) {
            return response()->json(['error' => 'Error while decoding token'], 400);
        }


        $user = User::find($credentials->sub);

        $request->auth = $user;


        return $next($request);
    }
}
