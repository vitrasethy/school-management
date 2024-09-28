<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryTypeRequest;
use App\Http\Resources\CategoryTypeResource;
use App\Models\CategoryType;
use Illuminate\Support\Facades\Gate;

class CategoryTypeController extends Controller
{
    public function __construct()
    {
        Gate::authorize('admin', CategoryType::class);
    }

    public function index()
    {
        return CategoryTypeResource::collection(CategoryType::all());
    }

    public function store(CategoryTypeRequest $request)
    {
        return new CategoryTypeResource(CategoryType::create($request->validated()));
    }

    public function show(CategoryType $categoryType)
    {
        return new CategoryTypeResource($categoryType);
    }

    public function update(CategoryTypeRequest $request, CategoryType $categoryType)
    {
        $categoryType->update($request->validated());

        return new CategoryTypeResource($categoryType);
    }

    public function destroy(CategoryType $categoryType)
    {
        $categoryType->delete();

        return response()->noContent();
    }
}
