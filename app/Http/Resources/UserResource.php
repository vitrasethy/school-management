<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Fetch unique category IDs from roles
        $categoryIds = $this->roles->pluck('pivot.category_id')->unique();
        $categories = Category::whereIn('id', $categoryIds)->pluck('name', 'id');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'is_super_admin' => $this->is_super_admin,

            // Add other user fields you need here
            'roles' => $this->roles->map(function ($role) use ($categories) {
                return [
                    'role' => $role->name,
                    'category' => $categories[$role->pivot->category_id] ?? null
                ];
            }),
        ];
    }
}
