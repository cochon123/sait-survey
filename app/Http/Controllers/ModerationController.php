<?php

namespace App\Http\Controllers;

use App\Services\ContentModerationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModerationController extends Controller
{
    protected ContentModerationService $moderationService;

    public function __construct(ContentModerationService $moderationService)
    {
        $this->moderationService = $moderationService;
    }

    /**
     * Vérifie la modération d'un pseudonyme
     */
    public function checkNickname(Request $request)
    {
        $request->validate([
            'nickname' => 'required|string|max:25'
        ]);

        $result = $this->moderationService->moderateNickname($request->nickname);

        return response()->json([
            'approved' => $result['approved'],
            'reason' => $result['reason']
        ]);
    }

    /**
     * Vérifie la modération d'une proposition
     */
    public function checkProposition(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:1000'
        ]);

        $title = $request->input('title', '');
        $content = $request->input('content');
        
        $result = $this->moderationService->moderateProposition($title, $content);

        return response()->json([
            'approved' => $result['approved'],
            'reason' => $result['reason']
        ]);
    }

    /**
     * Vérifie la modération d'un commentaire
     */
    public function checkComment(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500'
        ]);

        $result = $this->moderationService->moderateComment($request->input('content'));

        return response()->json([
            'approved' => $result['approved'],
            'reason' => $result['reason']
        ]);
    }
}