<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait ResponseAPI
{
    /**
     * Standard success response.
     */
    protected function success(string $message = null, $data = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'success'     => true,
            'status_code' => $code,
            'message'     => $message ?? 'Request successful',
            'data'        => $data,
        ], $code);
    }

    /**
     * Standard error response.
     */
    protected function error(string $message = null, $errors = null, int $code = 500): JsonResponse
    {
        return response()->json([
            'success'     => false,
            'status_code' => $code,
            'message'     => $message ?? 'Something went wrong',
            'errors'      => $errors,
        ], $code);
    }

   
}
