<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function sendResponse($result, $message){
        
        $response = [
            'data' => $result,
            'success' => true,
            'message' => $message
        ];

        return response()->json($response,200);
        
    }

    public function sendError($error, $errorMessage = []){
        
        $response = [
            'data' => null,
            'success' => false,
            'message' => $error
        ];

        if(!empty($errorMessage)){
            $response['message'] = $errorMessage;
        }

        return response()->json($response);
        
    } 

}
