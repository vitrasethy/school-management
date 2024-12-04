<?php

namespace App\Http\Controllers\Api\Auth;

use App\Attributes\RegisterOperation;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends BaseController
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
            'password' => Hash::make($request->string('password')),
        ]);

        //Auth::login($user);

        $token = $user->createToken($user->email)->plainTextToken;

        $user
            ->load('role')
            ->append([
                'token' => $token,
                'expires' => 24 * 60 * 60 * 1000,
            ]);

        $data = new AuthResource($user);

        return $this->successResponse($data);
    }
}
