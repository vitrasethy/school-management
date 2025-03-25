<?php

namespace App\Http\Controllers\Api\Auth;

use App\Attributes\LoginOperation;
use App\Attributes\LogoutOperation;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticatedSessionController extends BaseController
{
    #[LoginOperation]
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $token = $request
            ->user()
            ->createToken($request->email)
            ->plainTextToken;

        $user = [
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'role' => $request->user()->getRoleNames(),
            'token' => $token,
            'expires' => 24 * 60 * 60 * 1000,
        ];

        return $this->successResponse($user);
    }

    #[LogoutOperation]
    public function destroy(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
