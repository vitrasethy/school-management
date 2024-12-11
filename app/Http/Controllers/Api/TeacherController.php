<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends BaseController
{
    public function index()
    {
        return $this->successResponse(
            TeacherResource::collection(
                Teacher::all()
            )
        );
    }

    public function store(Request $request)
    {

    }

    public function show(Teacher $teacher)
    {
    }

    public function update(Request $request, Teacher $teacher)
    {
    }

    public function destroy(Teacher $teacher)
    {
    }
}
