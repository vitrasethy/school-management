<?php

namespace App\Http\Controllers;

use App\Attributes\GetCurrentUserOperation;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    #[GetCurrentUserOperation]
    public function getCurrentUser(Request $request): User
    {
        return $request->user();
    }
}
