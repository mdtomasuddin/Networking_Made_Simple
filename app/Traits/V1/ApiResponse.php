<?php

namespace App\Traits\V1;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{

    /**
     * Returns a standardized success response with the provided data, message, and HTTP status code.
     */
    public function success($code = 200, $message = null, $data = []): JsonResponse
    {
        return response()->json([
            'success'   => (bool) true,
            'code'      => (int) $code,
            'message'   => $message,
            'data'      => $data,
            'timestamp' => now()->toIso8601String() . ' GMT' . now()->format('P'),
        ], $code);
    }

    /**
     * Returns a standardized error response with the provided data, message, and HTTP status code.
     */
    public function error($code = 500, $message = null, $error = []): JsonResponse
    {
        return response()->json([
            'status'    => (bool) false,
            'code'      => (int) $code,
            'message'   => $message,
            'error'     => $error,
            'timestamp' => now()->toIso8601String() . ' GMT' . now()->format('P'),
        ], $code);
    }
}
