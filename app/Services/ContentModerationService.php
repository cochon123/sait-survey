<?php

namespace App\Services;

use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Log;
use Exception;

class ContentModerationService
{
    private const DEFAULT_TIMEOUT = 10; // 10 secondes
    private const MODEL = 'gemini-2.0-flash-lite';
    
    /**
     * Modère un pseudonyme utilisateur
     */
    public function moderateNickname(string $nickname): array
    {
        $prompt = $this->getNicknamePrompt($nickname);
        return $this->moderate($prompt, 'nickname');
    }
    
    /**
     * Modère une proposition
     */
    public function moderateProposition(?string $title, string $content): array
    {
        // Si le titre est null ou vide, on utilise une chaîne vide
        $title = $title ?? '';
        
        $prompt = $this->getPropositionPrompt($title, $content);
        return $this->moderate($prompt, 'proposition');
    }
    
    /**
     * Modère un commentaire
     */
    public function moderateComment(string $content): array
    {
        $prompt = $this->getCommentPrompt($content);
        return $this->moderate($prompt, 'comment');
    }
    
    /**
     * Fonction principale de modération
     */
    private function moderate(string $prompt, string $type): array
    {
        try {
            // Log de la tentative de modération
            Log::info("Content moderation attempt", [
                'type' => $type,
                'prompt_preview' => substr($prompt, 0, 100) . '...'
            ]);
            
            // Appel à l'API Gemini avec timeout
            $fullPrompt = $this->getSystemInstruction() . "\n\n" . $prompt;
            
            Log::info("Calling Gemini API", [
                'model' => self::MODEL,
                'full_prompt_length' => strlen($fullPrompt)
            ]);
            
            $result = Gemini::generativeModel(model: self::MODEL)
                ->generateContent($fullPrompt);
            
            $response = $result->text();
            
            Log::info("Gemini API response received", [
                'response_length' => strlen($response),
                'response_preview' => substr($response, 0, 200) . '...'
            ]);
            
            // Parse de la réponse JSON
            $cleanResponse = $this->cleanJsonResponse($response);
            $decodedResponse = json_decode($cleanResponse, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::warning("Invalid JSON response from Gemini", [
                    'original_response' => $response,
                    'cleaned_response' => $cleanResponse,
                    'json_error' => json_last_error_msg()
                ]);
                return $this->getFallbackResponse();
            }
            
            // Validation de la structure de réponse
            if (!isset($decodedResponse['decision']) || !isset($decodedResponse['reasoning'])) {
                Log::warning("Invalid response structure from Gemini", [
                    'response' => $decodedResponse,
                    'has_decision' => isset($decodedResponse['decision']),
                    'has_reasoning' => isset($decodedResponse['reasoning'])
                ]);
                return $this->getFallbackResponse();
            }
            
            $isSafe = strtolower($decodedResponse['decision']) === 'safe';
            
            Log::info("Content moderation result", [
                'type' => $type,
                'decision' => $decodedResponse['decision'],
                'safe' => $isSafe,
                'reasoning' => $decodedResponse['reasoning']
            ]);
            
            return [
                'approved' => $isSafe,
                'reason' => $decodedResponse['reasoning'],
                'decision' => $decodedResponse['decision']
            ];
            
        } catch (Exception $e) {
            Log::error("Content moderation failed", [
                'type' => $type,
                'error' => $e->getMessage(),
                'error_class' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Fallback : approuver le contenu en cas d'erreur
            return $this->getFallbackResponse();
        }
    }
    
    /**
     * Instructions système pour Gemini
     */
    private function getSystemInstruction(): string
    {
        return "You are a content moderator for SAIT Campus Voice, a university platform where students share ideas to improve campus life. 

Your task is to evaluate content and determine if it should be allowed or blocked. Be permissive with constructive criticism and creative ideas, but strict with harmful content.

ALWAYS respond in valid JSON format with exactly these fields:
{
    \"decision\": \"safe\" or \"unsafe\",
    \"reasoning\": \"brief explanation of your decision\"
}

ALLOW (respond with 'safe'):
- Constructive suggestions for campus improvement
- Criticism of facilities, services, or policies (even if strongly worded)
- Creative or humorous ideas
- Academic complaints or feedback
- Personal opinions about university life
- Mild frustration or disappointment
- Ideas that might seem 'trash' but are clearly harmless

BLOCK (respond with 'unsafe'):
- Hate speech targeting race, religion, gender, sexuality, etc.
- Threats of violence or harm
- Sexual harassment or explicit sexual content
- Personal attacks against specific individuals
- Doxxing or sharing private information
- Content promoting illegal activities
- Spam or completely off-topic content
- Content that could endanger student safety

When in doubt, choose 'safe' unless the content clearly violates safety guidelines.";
    }
    
    /**
     * Prompt spécifique pour les pseudonymes
     */
    private function getNicknamePrompt(string $nickname): string
    {
        return "Evaluate this nickname for a university student platform: \"{$nickname}\"

Consider if this nickname is appropriate for a campus community platform where students discuss improvements to university life.";
    }
    
    /**
     * Prompt spécifique pour les propositions
     */
    private function getPropositionPrompt(string $title, string $content): string
    {
        return "Evaluate this student proposition for campus improvement:

Title: \"{$title}\"
Content: \"{$content}\"

Determine if this proposition is appropriate for a university platform where students suggest improvements to campus life.";
    }
    
    /**
     * Prompt spécifique pour les commentaires
     */
    private function getCommentPrompt(string $content): string
    {
        return "Evaluate this comment on a student proposition:

Comment: \"{$content}\"

Determine if this comment is appropriate for a university discussion platform.";
    }
    
    /**
     * Réponse de fallback en cas d'erreur
     */
    private function getFallbackResponse(): array
    {
        return [
            'approved' => true,
            'reason' => 'Content approved (moderation service unavailable)',
            'decision' => 'safe'
        ];
    }

    /**
     * Nettoie la réponse JSON en supprimant les balises markdown
     */
    private function cleanJsonResponse(string $response): string
    {
        // Supprimer les balises de code markdown
        $cleaned = preg_replace('/```json\s*/', '', $response);
        $cleaned = preg_replace('/```\s*$/', '', $cleaned);
        
        // Supprimer les espaces en début et fin
        $cleaned = trim($cleaned);
        
        return $cleaned;
    }
}