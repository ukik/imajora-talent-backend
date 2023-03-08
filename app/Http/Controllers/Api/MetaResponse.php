<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;

class MetaResponse
{
    public static function success($payload = null): Response
    {
        $response = ['meta' => ['status' => 'success']];
        if ($payload) {
            $response['payload'] = $payload;
        }
        return response($response);
    }

    public static function successWithMsg(string $msg, $payload = null): Response
    {
        $response = ['meta' => ['status' => 'success', 'message' => $msg]];
        if ($payload) {
            $response['payload'] = $payload;
        }
        return response($response);
    }

    public static function error(string $msg, int $code = 500): Response
    {
        return response([
            'meta' => [
                'status' => 'error',
                'message' => $msg
            ],
        ], $code);
    }
}
