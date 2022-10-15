<?php

namespace BankI\Traits;

trait ApiResponseTrait
{
    public static function successResponse($data, $message = 'ok', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function failureResponse($message, $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }
}
