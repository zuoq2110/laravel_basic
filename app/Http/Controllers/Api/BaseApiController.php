<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

class BaseApiController extends Controller{
    public function sendResponse($result, $message = '', $code = 200){
        return response()->json([
            'success' => true,
            'data' => $result,
            'message' => $message,

        ], $code);
    }

    public function sendError($error, $code = 404){
        return response()->json([
            'sucess' => false,
            'message' => $error,

        ], $code);
    }

    public function sendValidationError($error, $code= 422){
        return response()->json([
            'success' => false,
            'message' => 'Validation error',
            'data' => $error
        ],$code);
    }
}