<?php

namespace App\Http\Controllers\Api;

use App\Attributes\GetCurrentUserOperation;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    #[GetCurrentUserOperation]
    public function getCurrentUser(Request $request)
    {
        $user = $request->user();

        return $this->successResponse(new UserResource($user));
    }

    public function show(User $user)
    {
        return $this->successResponse(new UserResource($user));
    }
}
