<?php

namespace App\Traits;

trait HttpResponses {
    protected function success($data, $code=200, $message="success"){
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => $message,
        ], $code);
    }
    protected function fail($message, $data=null, $code=400){
        return response()->json([
            'status' => false,
            'data' => $data,
            'message' => $message,
        ], $code);
    }
}
