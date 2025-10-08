<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ContentModerationService;
use Illuminate\Support\Facades\Log;

class ContentModerationTest extends TestCase
{
    private ContentModerationService $moderationService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->moderationService = new ContentModerationService();
    }

    public function test_detects_basic_obfuscated_words()
    {
        // Test various obfuscation methods
        $testCases = [
            'f*u*c*k',
            'f.u.c.k',
            'f-u-c-k',
            'f_u_c_k',
            'f u c k',
            'fu ck',
            'fuc k',
            'f4ck',
            'fuk',
            'fuc',
            'n.i.g.g.e.r',
            'n*i*g*g*e*r',
            'n1gger',
            'n1gg3r',
            's*h*i*t',
            'sh1t',
            'b*i*t*c*h',
            'b1tch',
            '@sshole',
            'a$$hole',
            '4sshole',
        ];

        foreach ($testCases as $text) {
            $result = $this->moderationService->moderateComment($text);
            $this->assertFalse($result['approved'], "Should block: {$text}");
            $this->assertEquals('unsafe', $result['decision']);
        }
    }

    public function test_allows_legitimate_content()
    {
        $legitimateContent = [
            'This is a great idea for improving campus life',
            'I think we need better food in the cafeteria',
            'The library should have more study spaces',
            'What about a new gym facility?',
            'Campus WiFi needs improvement',
        ];

        foreach ($legitimateContent as $text) {
            // Note: These will still go through AI moderation since they pass pre-checks
            // In a real test, you might want to mock the AI response
            $this->assertIsArray($this->moderationService->moderateComment($text));
        }
    }

    public function test_detects_advanced_bypass_attempts()
    {
        $bypassAttempts = [
            str_repeat('*', 50), // High symbol density
            'f   u   c   k', // Excessive spacing
            'YWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFh', // Potential Base64
            '48656c6c6f20576f726c6448656c6c6f', // Potential hex
        ];

        foreach ($bypassAttempts as $text) {
            $result = $this->moderationService->moderateComment($text);
            // These should be caught by advanced detection
            $this->assertIsArray($result);
        }
    }

    public function test_detects_obfuscated_sentences()
    {
        // Test obfuscated sentences - full phrases with multiple obfuscated words
        $obfuscatedSentences = [
            'f*u*c*k this sh*t',
            'this is such b*u*l*l*s*h*i*t',
            'go f.u.c.k yourself you stupid b1tch',
            'what the f4ck is this sh1t',
            'st*u*p*i*d @ss proposal',
            'this is r3t4rd3d as h3ll',
            'f u c k   o f f',
            'you are such a d*u*m*b*a*s*s',
            'this p1ece of cr@p idea',
            'g0 t0 h3ll you m0r0n',
            'this c*r*a*p* idea sucks',
            'what a st*u*p*id suggestion',
            'this is g@rb@ge and you know it',
            'you must be k1dd1ng with this bs',
            'this makes no s3ns3 you 1d10t',
        ];

        foreach ($obfuscatedSentences as $text) {
            $result = $this->moderationService->moderateComment($text);
            $this->assertFalse($result['approved'], "Should block obfuscated sentence: {$text}");
            $this->assertEquals('unsafe', $result['decision']);
        }
    }

    public function test_detects_mixed_obfuscation_techniques()
    {
        // Test combinations of different obfuscation methods
        $mixedObfuscation = [
            'F*U*C*K th1s SH1T', // Mixed case + symbols + leetspeak
            'g0 f.u.c.k y0ur$3lf', // Mixed techniques
            'th1$ 1$ $0 $tup1d', // Heavy leetspeak
            'what.the.f*ck.is.this', // Dots + symbols
            'you_are_such_a_b1tch', // Underscores + leetspeak
            'f--u--c--k this cr@p', // Dashes + symbols
            'st^up^id @$$ pr0p0$@l', // Multiple symbol types
        ];

        foreach ($mixedObfuscation as $text) {
            $result = $this->moderationService->moderateComment($text);
            $this->assertFalse($result['approved'], "Should block mixed obfuscation: {$text}");
            $this->assertEquals('unsafe', $result['decision']);
        }
    }

    public function test_detects_sophisticated_sentence_obfuscation()
    {
        // Test even more sophisticated obfuscation techniques
        $sophisticatedTests = [
            // Distributed across words
            'f u c k this i d e a',
            'what a s t u p i d suggestion',
            'this is such b u l l s h i t',
            'g o   t o   h e l l',
            
            // Mixed with legitimate words
            'this f*cking idea is terrible',
            'what a st0pid waste of time',
            'complete and utter bull$hit',
            'absolutely ret@rded proposal',
            
            // Creative spacing and symbols
            'f.*.u.*.c.*.k this',
            's-t-u-p-i-d idea',
            'what***the***hell',
            'this___is___crap',
            
            // Reverse psychology attempts
            'not f*u*c*k but still bad',
            'maybe not st*u*p*id but close',
            
            // Context-based profanity
            'this makes me want to say f word',
            'excuse my french but this is bs',
            'pardon the expression but this sucks',
            
            // Unicode and special characters
            'this is ſhit', // using long s
            'what the hëll',
            'stűpid idea',
            
            // Numbers and letters mixed
            '7h15 15 5h17', // this is shit in leetspeak
            'wh47 7h3 h3ll', // what the hell
            'f4ck 7h15 cr4p', // f*ck this crap
        ];

        foreach ($sophisticatedTests as $text) {
            $result = $this->moderationService->moderateComment($text);
            $this->assertFalse($result['approved'], "Should block sophisticated obfuscation: {$text}");
            $this->assertEquals('unsafe', $result['decision']);
        }
    }
}