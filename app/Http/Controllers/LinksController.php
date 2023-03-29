<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateLinkRequest;
use App\Services\LinksService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function __construct(private readonly LinksService $linksService)
    {
    }

    public function show(string $token): View
    {
        $link = $this->linksService->showLink($token);

        return view('links.show', [
            'link' => url('') . '/' . $link->token
        ]);
    }

    public function createLink(CreateLinkRequest $request): RedirectResponse
    {
        try {
            $link = $this->linksService->createLink($request);

            return redirect()->route('links.show', $link->token);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $request->session()->flash('error', $errorMessage);

            return redirect()->back();
        }
    }

    public function redirect(string $token, Request $request): View|RedirectResponse
    {
        try {
            $link = $this->linksService->redirectToOriginal($token, $request);

            return view('links.redirect', [
                'url' => $link->url
            ]);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $request->session()->flash('error', $errorMessage);

            return redirect()->back();
        }
    }
}
