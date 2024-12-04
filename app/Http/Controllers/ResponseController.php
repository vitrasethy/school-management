<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\ResponseRequest;
use App\Http\Resources\ResponseResource;
use App\Models\Response;

class ResponseController extends BaseController
{
    public function index()
    {
        $responses = Response::all();

        $data = ResponseResource::collection($responses);

        return $this->successResponse($data);
    }

    public function store(ResponseRequest $request)
    {
        $validated = $request->validated();

        $response = Response::create($validated);

        $data = new ResponseResource($response);

        return $this->successResponse($data);
    }

    public function show(Response $response)
    {
        $data = new ResponseResource($response);

        return $this->successResponse($data);
    }

    public function update(ResponseRequest $request, Response $response)
    {
        $validated = $request->validated();

        $response->update($validated);

        return $this->successResponse($response);
    }

    public function destroy(Response $response)
    {
        $response->delete();

        return $this->successResponse([]);
    }
}
