<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    // 200 => success, 2001 => created, 403 => unauthorized, 404 => not found, 500 => server, 
    public function successResponse($data, $message = 'Operation successful', $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode,
        ], $statusCode);
    }


    public function errorResponse($message = 'An error occurred', $statusCode = 400): JsonResponse
    {
        return response()->json([
            'error' => $message,
            'status' => $statusCode,
        ], $statusCode);
    }
}
