<?php

namespace App\Http\Controllers;

use App\Services\ContentModerationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        Log::info('Moderation request received', [
            'type' => 'comment',
            'data' => $request->all(),
            'user_id' => Auth::id()
        ]);
        
        $request->validate([
            'nickname' => 'required|string|max:25'
        ]);

        $result = $this->moderationService->moderateNickname($request->nickname);

        Log::info('Moderation response', [
            'type' => 'nickname',
            'result' => $result
        ]);

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
        Log::info('Moderation request received', [
            'type' => 'proposition',
            'data' => $request->all(),
            'user_id' => Auth::id()
        ]);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:1000'
        ]);

        $title = $request->input('title', '');
        $content = $request->input('content');
        
        Log::info('Extracted data for moderation', [
            'title' => $title,
            'content' => $content,
            'title_type' => gettype($title),
            'content_type' => gettype($content)
        ]);

        $result = $this->moderationService->moderateProposition($title, $content);

        Log::info('Moderation response', [
            'type' => 'proposition',
            'result' => $result
        ]);

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