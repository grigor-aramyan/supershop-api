<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\User;
use App\Store;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Register new user and login afterwards
     */
    public function register(Request $request)
    {

        $register_data = $request->register;

        if (!isset($register_data['name']) || !isset($register_data['email']) || !isset($register_data['password'])
            || !isset($register_data['surname']) || !isset($register_data['type']))
        {
            return response()->json(array(
                'error' => 'all fields required'
            ), 400);
        }

        if ($register_data['type'] == 'COMPANY' && !isset($register_data['company_name']))
        {
            return response()->json(array(
                'error' => 'company name required for registering company account'
            ), 400);
        }
        
        $credentials = [
            'name' => $register_data['name'],
            'surname' => $register_data['surname'],
            'email' => $register_data['email'],
            'password' => bcrypt($register_data['password']),
            'type' => $register_data['type']
        ];

        try {
            $user = User::create($credentials);
        } catch (Exception $e)
        {
            return response()->json(array(
                'error' => $e
            ), 500);
        }

        if (isset($user['id']))
        {

            if ($user['type'] == 'COMPANY')
            {
                $store_credentials = [
                    'name' => $register_data['company_name'],
                    'description' => 'some default description',
                    'db_username' => 'default_db_username',
                    'db_password' => 'default_db_password',
                    'db_uri' => 'default_db_uri',
                    'store_uri' => 'default.example.com',
                    'logo_uri' => 'https://www.erpsoftwareblog.com/wp-content/uploads/coke-logo-2.jpg'
                ];

                try {
                    $created_store = $user->store()->save(new Store($store_credentials));
                } catch (Exception $e)
                {
                    $user->delete();

                    return response()->json(array(
                        'error' => 'couldn\'t register company. try later or contact with us, please'
                    ), 500);
                }

            }

            $token = auth()->login($user);

            if ($token)
            {

                return $this->respondWithToken($user['type'], $token, 201);

            } else
            {
                return response()->json(array(
                    'error' => 'server error'
                ), 500);
            }

        } else
        {
            return response()->json(array(
                'error' => 'unable to create user'
            ), 400);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $user_creds = $request->user;
        $credentials = [
            'email' => $user_creds['email'],
            'password' => $user_creds['password']
        ];

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $current_user = auth()->user();

        return $this->respondWithToken($current_user['type'], $token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {

        $current_user = auth()->user();

        if ($current_user['type'] == 'USER')
        {
            return response()->json([
                'user' => auth()->user()
            ]);
        } else
        {
            $current_user->load(['store']);
            return response()->json([
                'user' => $current_user
            ]);
        }

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->user()['type'], auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($user_type, $token, $status_code = 200)
    {
        return response()->json([
            'user_type' => $user_type,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], $status_code);
    }

    /**
     * Get the user with token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithUserAndToken($user, $token, $status_code = 200)
    {
        $token_data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];

        return response()->json([
            'user' => $user,
            'token' => $token_data
        ], $status_code);
    }
}
