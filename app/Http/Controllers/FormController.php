<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\FormRequest;
use App\Http\Resources\FormResource;
use App\Models\Form;

class FormController extends BaseController
{
    public function index()
    {
        $forms = Form::all();

        $data = FormResource::collection($forms);

        return $this->successResponse($data);
    }

    public function store(FormRequest $request)
    {
        $validated = $request->validated();

        $form = Form::create($validated);

        $data = new FormResource($form);

        return $this->successResponse($data, 201);
    }

    public function show(Form $form)
    {
        $data = new FormResource($form);

        return $this->successResponse($data);
    }

    public function update(FormRequest $request, Form $form)
    {
        $validated = $request->validated();

        $form->update($validated);

        $data = new FormResource($form);

        return $this->successResponse($data);
    }

    public function destroy(Form $form)
    {
        $form->delete();

        return $this->successResponse([]);
    }
}
