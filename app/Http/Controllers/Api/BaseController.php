<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use function response;

class BaseController extends Controller
{
    protected function successResponse($data, $statusCode = 200, $message = null): JsonResponse
    {
        if ($data instanceof JsonResource) {
            // Add additional data to the resource
            return $data->additional([
                'success' => true,
                'message' => $message,
            ])->response()->setStatusCode($statusCode);
        } else {
            // For non-resource data
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => $message,
            ], $statusCode);
        }
    }

    protected function errorResponse($message, $statusCode = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }

    protected function noContentResponse($message = null): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [],
            'message' => $message,
        ], 204);
    }
}
