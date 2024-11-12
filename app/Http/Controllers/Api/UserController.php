<?php

namespace App\Http\Controllers\Api;

use App\Attributes\GetCurrentUserOperation;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    #[GetCurrentUserOperation]
    public function getCurrentUser(Request $request)
    {
        $user = $request->user()->load('role');

        return $this->successResponse(new UserResource($user));
    }
}
