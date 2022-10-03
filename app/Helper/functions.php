<?php

function successResponse($code = 200, $data, $message = null)
{
    return response()->json([
        'status'=> 'Success',
        'message' => $message,
        'data' => $data
    ], $code);
}
function errorResponse($code, $data = null, $message = null)
{
    return response()->json([
        'status'=>'Error',
        'message' => $message,
        'data' => $data
    ], $code);
}
