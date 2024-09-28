<?php

namespace App\Http\Controllers\Auth;

use App\Attributes\LoginOperation;
use App\Attributes\LogoutOperation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    #[LoginOperation]
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $token = $request->user()->createToken($request->email)->plainTextToken;

        return response()->json([
            "token" => $token,
            'expires' => 24 * 60 * 60
        ]);
    }

    /**
     * Destroy a token from database.
     */
    #[LogoutOperation]
    public function destroy(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
