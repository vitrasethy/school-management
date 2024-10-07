<?php

namespace App\Http\Controllers;

use App\Attributes\GetCurrentUserOperation;
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
