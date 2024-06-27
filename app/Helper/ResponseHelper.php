<?php

namespace App\Helper;

class ResponseHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    /**
     * Function to display response for success - JSON Response.
     * @param string $status
     * @param string $message
     * @param array $data
     * @param integer $statusCode
     * @return response
     */

    public static function success($status = 'success', $message = null, $data = [], $statusCode = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }


    /**
     * Function to display response for Error(404) - JSON Response.
     * @param string $status
     * @param string $message
     * @param array $data
     * @param integer $statusCode
     * @return response
     */

    public static function error($status = 'error', $message = null, $data = [], $statusCode = 404)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $statusCode);
    }
}
