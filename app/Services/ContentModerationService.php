<?php

namespace App\Services;

use Gemini\Laravel\Facades\Gemini;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Service de modération de contenu avec support des emojis
 * 
 * Ce service effectue la modération de contenu tout en préservant
 * l'utilisation légitime des emojis Unicode. Il utilise des techniques
 * de normalisation intelligente pour détecter les mots interdits
 * sans faux positifs sur les emojis.
 */
class ContentModerationService
{
    private const DEFAULT_TIMEOUT = 10; // 10 secondes
    private const MODEL = 'gemma-3-1b-it';
    
    /**
     * Modère un pseudonyme utilisateur
     * Supporte les emojis Unicode tout en bloquant le contenu inapproprié
     */
    public function moderateNickname(string $nickname): array
    {
        // Server-side pre-check for obfuscated banned words
        $banned = $this->detectObfuscatedBannedWords($nickname);
        if ($banned !== null) {
            Log::warning("Obfuscated banned word detected in nickname: {$banned}");
            return [
                'approved' => false,
                'reason' => 'Contains disallowed language (obfuscated)',
                'decision' => 'unsafe'
            ];
        }

        // Check for advanced bypass attempts
        if ($this->detectAdvancedBypass($nickname)) {
            Log::warning("Advanced bypass attempt detected in nickname: {$nickname}");
            return [
                'approved' => false,
                'reason' => 'Suspicious content pattern detected',
                'decision' => 'unsafe'
            ];
        }

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
        
        // Pre-check both title and content for obfuscated banned words
        $bannedTitle = $this->detectObfuscatedBannedWords($title);
        $bannedContent = $this->detectObfuscatedBannedWords($content);

        if ($bannedTitle !== null || $bannedContent !== null) {
            $detected = $bannedTitle ?? $bannedContent;
            Log::warning("Obfuscated banned word detected in proposition: {$detected}");
            return [
                'approved' => false,
                'reason' => 'Contains disallowed language (obfuscated)',
                'decision' => 'unsafe'
            ];
        }

        // Check for advanced bypass attempts
        if ($this->detectAdvancedBypass($title) || $this->detectAdvancedBypass($content)) {
            Log::warning("Advanced bypass attempt detected in proposition: title='{$title}', content='{$content}'");
            return [
                'approved' => false,
                'reason' => 'Suspicious content pattern detected',
                'decision' => 'unsafe'
            ];
        }

        $prompt = $this->getPropositionPrompt($title, $content);
        return $this->moderate($prompt, 'proposition');
    }
    
    /**
     * Modère un commentaire
     */
    public function moderateComment(string $content): array
    {
        // Pre-check comment content for obfuscated banned words
        $banned = $this->detectObfuscatedBannedWords($content);
        if ($banned !== null) {
            Log::warning("Obfuscated banned word detected in comment: {$banned}");
            return [
                'approved' => false,
                'reason' => 'Contains disallowed language (obfuscated)',
                'decision' => 'unsafe'
            ];
        }

        // Check for advanced bypass attempts
        if ($this->detectAdvancedBypass($content)) {
            Log::warning("Advanced bypass attempt detected in comment: {$content}");
            return [
                'approved' => false,
                'reason' => 'Suspicious content pattern detected',
                'decision' => 'unsafe'
            ];
        }

        $prompt = $this->getCommentPrompt($content);
        return $this->moderate($prompt, 'comment');
    }
    
    /**
     * Fonction principale de modération
     */
    private function moderate(string $prompt, string $type): array
    {
        try {
            // Appel à l'API Gemini avec timeout
            $fullPrompt = $this->getSystemInstruction() . "\n\n" . $prompt;
            
            $result = Gemini::generativeModel(model: self::MODEL)
                ->generateContent($fullPrompt);
            
            $response = $result->text();
            
            // Log the AI response for debugging
            Log::info("AI Moderation Response for {$type}: " . $response);
            
            // Parse de la réponse JSON
            $cleanResponse = $this->cleanJsonResponse($response);
            $decodedResponse = json_decode($cleanResponse, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->getFallbackResponse();
            }
            
            // Validation de la structure de réponse
            if (isset($decodedResponse['decision']) === false || isset($decodedResponse['reasoning']) === false) {
                return $this->getFallbackResponse();
            }
            
            $isSafe = strtolower($decodedResponse['decision']) === 'safe';
            
            // Log bypass attempts for monitoring
            if (!$isSafe && strpos(strtolower($decodedResponse['reasoning']), 'bypass') !== false) {
                Log::warning("Bypass attempt detected for {$type}: " . $response);
            }
            
            return [
                'approved' => $isSafe,
                'reason' => $decodedResponse['reasoning'],
                'decision' => $decodedResponse['decision']
            ];
            
        } catch (Exception $e) {
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
- Content that uses special characters, spacing, or leetspeak to disguise offensive words (e.g., f*u*c*k, n.i.g.g.e.r, s*h*i*t)
- Any attempt to bypass content filters through character substitution or obfuscation

IMPORTANT: Detect and block content that tries to circumvent filters by:
- Replacing letters with similar-looking characters (*, @, numbers)
- Using excessive spacing between letters
- Using dots or other punctuation between letters
- Leetspeak substitutions (e.g., 4 for 'a', 3 for 'e', 1 for 'i')
- Any other method to disguise profanity or hate speech

When in doubt, choose 'safe' unless the content clearly violates safety guidelines.";
    }

    /**
     * Normalize a string to improve matching of obfuscated words.
     * - Lowercase
     * - Replace common leet substitutions and symbols
     * - Remove punctuation and repeated non-word characters
     * - Collapse whitespace and repeated characters
     */
    private function normalizeForMatching(string $text): string
    {
        // Lowercase
        $s = mb_strtolower($text, 'UTF-8');

        // Get normalization rules from config
        $replacements = config('moderation.normalization_rules', []);

        foreach ($replacements as $search => $replace) {
            $s = str_replace($search, $replace, $s);
        }

        // Remove all punctuation, spaces, dots, stars, underscores, etc.
        // BUT preserve emojis by excluding them from removal
        $s = preg_replace('/[^\p{L}\p{N}\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F1E0}-\x{1F1FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u', '', $s);

        // Collapse repeated characters (e.g., loooool -> lol, shiiit -> shit)
        $s = preg_replace('/(.)\1{1,}/u', '\\1', $s);

        return $s;
    }

    /**
     * Remove emojis from text for banned word detection
     */
    private function removeEmojis(string $text): string
    {
        return preg_replace('/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F1E0}-\x{1F1FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u', '', $text);
    }

    /**
     * Detect obfuscated banned words in a given text. Returns the matched banned word or null.
     */
    private function detectObfuscatedBannedWords(string $text): ?string
    {
        // Remove emojis from text for banned word detection to avoid false positives
        $textWithoutEmojis = $this->removeEmojis($text);
        $normalized = $this->normalizeForMatching($textWithoutEmojis);

        if ($normalized === '') return null;

        // Get banned words from config
        $banned = config('moderation.banned_words', []);

        foreach ($banned as $bad) {
            $normalizedBad = $this->normalizeForMatching($bad);
            if ($normalizedBad === '') continue;

            // Check for exact match and substring match
            if ($normalized === $normalizedBad || strpos($normalized, $normalizedBad) !== false) {
                Log::info("Banned word detection: '{$text}' normalized to '{$normalized}' contains '{$normalizedBad}'");
                return $bad;
            }
        }

        // Additional check for patterns that bypass normalization
        $patterns = config('moderation.bypass_patterns', []);

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $text)) {
                Log::info("Pattern detection: '{$text}' matches pattern '{$pattern}'");
                return 'obfuscated_profanity';
            }
        }

        // Enhanced sentence-level detection
        $sentenceCheck = $this->detectObfuscatedInSentence($text);
        if ($sentenceCheck !== null) {
            return $sentenceCheck;
        }

        return null;
    }

    /**
     * Analyze sentences for obfuscated words by checking individual words and word boundaries
     */
    private function detectObfuscatedInSentence(string $text): ?string
    {
        // Remove emojis for banned word detection
        $textWithoutEmojis = $this->removeEmojis($text);
        
        // Split text into words while preserving separators for analysis
        $words = preg_split('/\s+/', $textWithoutEmojis, -1, PREG_SPLIT_NO_EMPTY);
        
        foreach ($words as $word) {
            // Clean the word but preserve enough structure for word boundary detection
            $cleanWord = preg_replace('/[^\p{L}\p{N}\*\.\-_@#$!]+/u', '', $word);
            
            if (strlen($cleanWord) < 3) continue; // Skip very short words
            
            // Check if this word contains obfuscated profanity
            $normalized = $this->normalizeForMatching($cleanWord);
            $banned = config('moderation.banned_words', []);
            
            foreach ($banned as $bad) {
                $normalizedBad = $this->normalizeForMatching($bad);
                if ($normalizedBad === '') continue;
                
                // For sentence analysis, check both exact matches and substrings
                if ($normalized === $normalizedBad || strpos($normalized, $normalizedBad) !== false) {
                    Log::info("Sentence-level detection: word '{$cleanWord}' in '{$text}' contains '{$bad}'");
                    return $bad;
                }
            }
        }

        // Check for distributed obfuscation across multiple words
        $condensed = $this->normalizeForMatching(str_replace(' ', '', $textWithoutEmojis));
        $banned = config('moderation.banned_words', []);
        
        foreach ($banned as $bad) {
            $normalizedBad = $this->normalizeForMatching($bad);
            if ($normalizedBad === '') continue;
            
            if (strpos($condensed, $normalizedBad) !== false) {
                Log::info("Distributed obfuscation detected: '{$text}' contains '{$bad}' when spaces removed");
                return $bad;
            }
        }

        // Additional check for compound racial slurs that might be missed
        $compoundPatterns = [
            '/dirty\s*hispanic/i' => 'dirty hispanic',
            '/dirty\s*spic/i' => 'dirty spic',
            '/stupid\s*mexican/i' => 'stupid mexican',
            '/dumb\s*nigger/i' => 'racial slur compound',
            '/lazy\s*mexican/i' => 'lazy mexican',
            '/wetback\s*count/i' => 'racial slur compound',
            '/hispanic\s*count/i' => 'racial counting slur',
        ];

        foreach ($compoundPatterns as $pattern => $description) {
            if (preg_match($pattern, $textWithoutEmojis)) {
                Log::warning("Compound racial slur detected: '{$text}' matches pattern for '{$description}'");
                return $description;
            }
        }

        return null;
    }

    /**
     * Additional checks for sophisticated bypass attempts
     */
    private function detectAdvancedBypass(string $text): bool
    {
        $thresholds = config('moderation.detection_thresholds', [
            'symbol_density_max' => 0.4,
            'min_encoded_length' => 20,
        ]);

        // Check for excessive punctuation or symbols that might hide words
        $symbolDensity = preg_match_all('/[^\p{L}\p{N}\s]/u', $text);
        $textLength = mb_strlen($text, 'UTF-8');
        
        if ($textLength > 0 && ($symbolDensity / $textLength) > $thresholds['symbol_density_max']) {
            Log::info("High symbol density detected: {$text}");
            return true;
        }

        // Check for excessive spacing between characters
        if (preg_match('/\b\w(\s+\w){3,}\b/', $text)) {
            Log::info("Excessive character spacing detected: {$text}");
            return true;
        }

        // Check for Base64 or hex encoded content that might contain profanity
        $minLength = $thresholds['min_encoded_length'];
        if (preg_match("/^[A-Za-z0-9+\/=]{{$minLength},}$/", trim($text)) || 
            preg_match("/^[0-9A-Fa-f]{{$minLength},}$/", trim($text))) {
            Log::info("Potential encoded content detected: {$text}");
            return true;
        }

        return false;
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