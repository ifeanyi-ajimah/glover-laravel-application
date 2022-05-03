<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AppJsonResponse {
    
    public static function successResponse($payload = null, string $message = null, int $code = Response::HTTP_OK, $errors = null): JsonResponse {
        return response()->json([
            'meta' => [
                'status' => true,
                'message' => $message,
            ],
            'payload' => $payload,
            'errors' => $errors,
        ], $code);
    }

    public static function failureResponse(int $code, string $message = null, $errors = null, $payload = null): JsonResponse {
        return response()->json([
            'meta' => [
                'status' => false,
                'message' => $message,
            ],
            'payload' => $payload,
            'errors' => $errors,
        ], $code);
    }

    public static function notFound($message = 'resource not found'): JsonResponse {
        return response()->json([
            'status' => [
                'code' => Response::HTTP_NOT_FOUND,
                'text' => 'not found'
            ],
            'message' => $message,
            'data' => null
        ], Response::HTTP_NOT_FOUND);
    }
    
}


