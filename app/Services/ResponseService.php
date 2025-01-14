<?php

namespace App\Services;

class ResponseService
{
    /**
     * @param mixed $data
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     */
    public static function successResponse($data, $code = 200) {
        return response()->json([
            'status' => 'success',
            'code' => $code,
            'data' => $data,
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }
    /**
     * @param string $message
     * @param int $code
     */
    public static function errorResponse($message, $code = 400) {
        return response()->json([
            'status' => 'error',
            'code' => $code,
            'message' => $message,
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }
}