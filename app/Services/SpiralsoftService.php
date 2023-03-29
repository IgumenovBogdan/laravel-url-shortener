<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SpiralsoftService
{
    public function __construct(
        private readonly string $getSpiralsoftUrl
    ) {
    }

    public function sendCreate(Request $request, $link): string
    {
        $response = Http::post($this->getSpiralsoftUrl, [
            'action' => 'create',
            'url' => $link->url,
            'useragent' => $request->header('user-agent'),
            'ip' => $request->ip(),
            'key' => $link->token,
        ]);

        if (json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['status'] === 'error') {
            $message = "Something went wrong";
            Log::info($response);
            throw new Exception($message);
        }

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['status'];
    }

    public function sendVisit(Request $request, $link): string
    {
        $response = Http::post($this->getSpiralsoftUrl, [
            'action' => 'visit',
            'useragent' => $request->header('user-agent'),
            'ip' => $request->ip(),
            'key' => $link->token,
        ]);

        if (json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['status'] === 'error') {
            $message = "Something was wrong";
            Log::info($response);
            throw new Exception($message);
        }

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['status'];
    }
}
