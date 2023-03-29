<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\CreateLinkRequest;
use App\Models\Link;
use App\Repositories\LinksRepository;
use Illuminate\Http\Request;

class LinksService
{
    public function __construct(
        private readonly TokenService $tokenService,
        private readonly LinksRepository $linksRepository,
        private readonly SpiralsoftService $spiralsoftService
    ) {
    }

    public function showLink(string $token): Link
    {
        $token = $this->tokenService->makeReadable($token);

        return $this->linksRepository->findByToken($token);
    }

    public function createLink(CreateLinkRequest $request): Link
    {
        if ($this->linksRepository->findByUrl($request->url, $request->session_id) !== null) {
            return $this->linksRepository->findByUrl($request->url, $request->session_id);
        }

        do {
            $token = $this->tokenService->createToken();
        } while (Link::where('token', $token)->exists());

        $link = Link::create([
            'url' => $request->url,
            'token' => $token,
            'session_id' => $request->session_id
        ]);

        $this->spiralsoftService->sendCreate($request, $link);

        return $link;
    }

    public function redirectToOriginal(string $token, Request $request): Link
    {
        $link = $this->linksRepository->findByToken($token);

        $this->spiralsoftService->sendVisit($request, $link);

        return $link;
    }
}
