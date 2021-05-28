<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Services\Authentication\AuthenticationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Register
     * @param RegisterRequest $request
     * @param AuthenticationService $authenticationService
     * @return JsonResponse
     */
    public function index(RegisterRequest $request, AuthenticationService $authenticationService){
        $token = $authenticationService->register($request->get('name'), $request->get('email'), $request->get('password'));

        return response()->json(
            [
                'token' => $token
            ], 201
        );
    }
}
