<?php

if (!function_exists('successResponse')) {
    /**
     * Return a success JSON response
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    function successResponse($data, $message = 'Success', $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}

if (!function_exists('errorResponse')) {
    /**
     * Return an error JSON response
     *
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    function errorResponse($message = 'Error', $code = 500)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => null,
        ], $code);
    }
}

if (!function_exists('notFoundResponse')) {
    /**
     * Return a not found JSON response
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    function notFoundResponse($message = 'Resource not found')
    {
        return errorResponse($message, 404);
    }
}

if (!function_exists('badRequestResponse')) {
    /**
     * Return a bad request JSON response
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    function badRequestResponse($message = 'Bad Request')
    {
        return errorResponse($message, 400);
    }
}
