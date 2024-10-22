<?php

namespace App\Http\Controllers\Api;

use App\Attributes\GetCurrentUserOperation;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    #[GetCurrentUserOperation]
    public function getCurrentUser(Request $request)
    {
        $user = $request->user()->load('roles');

        return new UserResource($user);
    }
}
