<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function success($data = [], string $message = 'Operation successful', int $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
