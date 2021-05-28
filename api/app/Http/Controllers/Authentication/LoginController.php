<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Services\Authentication\AuthenticationService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /**
     * Login
     *
     * @param LoginRequest $request
     * @param AuthenticationService $authenticationService
     * @return JsonResponse
     */
    public function index(LoginRequest $request, AuthenticationService $authenticationService): JsonResponse
    {
        $token = $authenticationService->login($request->get('email'), $request->get('password'));

        if($token !== null){
            return response()->json(
                [
                    'token' => $token
                ], 200
            );
        }

        return response()->json(
            [
                'message'   => 'Invalid credentials',
                'errors'    => [
                    'login' => ['INVALID_CREDENTIALS']
                ]
            ], 401
        );
    }
}
