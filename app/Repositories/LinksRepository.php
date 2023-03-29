<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Link;
use Illuminate\Http\Request;

class LinksRepository
{
    public function findByToken(string $token): Link
    {
        return Link::where('token', $token)->first();
    }

    public function findByUrl(string $url, string $sessionId): Link|null
    {
        return Link::where('url', $url)->where('session_id', $sessionId)->first();
    }
}
