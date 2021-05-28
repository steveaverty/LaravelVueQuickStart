<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInformationController extends Controller
{
    /**
     * Return authenticated user
     * @return JsonResponse
     */
    public function me(): JsonResponse{
        return response()->json(new UserResource(Auth::user()), 200);
    }
}
