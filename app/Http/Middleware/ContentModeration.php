<?php

namespace App\Http\Middleware;

use App\Services\ContentModerationService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ContentModeration
{
    protected ContentModerationService $moderationService;

    public function __construct(ContentModerationService $moderationService)
    {
        $this->moderationService = $moderationService;
    }

    public function handle(Request $request, Closure $next, string $type = 'general')
    {
        // Vérifie si la requête contient du contenu à modérer
        $moderationResult = $this->moderateContent($request, $type);
        
        if (!$moderationResult['approved']) {
            return response()->json([
                'moderation_failed' => true,
                'reason' => $moderationResult['reason'],
                'decision' => $moderationResult['decision']
            ], 422);
        }

        return $next($request);
    }

    private function moderateContent(Request $request, string $type): array
    {
        switch ($type) {
            case 'nickname':
                return $this->moderationService->moderateNickname(
                    $request->input('nickname', '')
                );
                
            case 'proposition':
                return $this->moderationService->moderateProposition(
                    $request->input('title', ''),
                    $request->input('content', '')
                );
                
            case 'comment':
                return $this->moderationService->moderateComment(
                    $request->input('content', '')
                );
                
            default:
                // Pour les cas généraux, modère tous les champs texte
                $textContent = collect($request->all())
                    ->filter(fn($value) => is_string($value))
                    ->implode(' ');
                    
                return $this->moderationService->moderateComment($textContent);
        }
    }
}