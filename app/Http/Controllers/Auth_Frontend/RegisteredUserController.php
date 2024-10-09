<?php

namespace App\Http\Controllers\Auth;

use App\Attributes\RegisterOperation;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    #[RegisterOperation]
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_super_admin' => false,
            'password' => Hash::make($request->string('password')),
        ]);

        Auth::login($user);

        $token = $user->createToken($user->email)->plainTextToken;

        $user_resource = new UserResource($user->load('roles'));

        return response()->json([
            'token' => $token,
            'expires' => 24 * 60 * 60 * 1000,
            ...$user_resource->toArray($request),
        ]);
    }
}
