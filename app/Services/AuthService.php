<?php

namespace App\Services;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{

    /**
     * Handle user registration
     *
     * @param array $data incoming data containing registration credentials
     * @return array The registration success response including token and user details
     */
    public function register(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        // $user->assignRole('user');
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['first_name'] = $user->first_name;
        $success['last_name'] = $user->last_name;

        return $success;
    }

    /**
     * Handle user login
     *
     * @param array $data The incoming data containing email and password
     * @return array|bool The authenticated user and token on success (false on failure)
     */
    public function login(array $data)
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        }

        return false;
    }

    /**
     * Handle user logout
     *
     * Deletes all tokens for the authenticated user
     *
     * @return int number of tokens deleted 
     */
    public function logout()
    {
        return auth()->user()->currentAccessToken()->delete();
    }
}
