<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Content Moderation Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration for the content moderation system
    | including banned words lists and detection parameters.
    |
    */

    'banned_words' => [
        // Racial slurs
        'nigger', 'nigga', 'negro', 'coon', 'spic', 'chink', 'gook', 'kike', 'beaner', 'wetback',
        'towelhead', 'sandnigger', 'raghead', 'camel jockey', 'curry muncher', 'rice picker',
        'slant', 'zipperhead', 'jungle bunny', 'porch monkey', 'welfare queen',
        
        // Hispanic/Latino slurs
        'spic', 'beaner', 'wetback', 'greaser', 'pepper belly', 'border hopper',
        'dirty hispanic', 'dirtyhispanic', 'hispanicount', 'dirty spic', 'dirtyspic',
        
        // Sexual/profanity
        'fuck', 'fucking', 'fucked', 'fucker', 'fck', 'fuk', 'fuc',
        'shit', 'shitting', 'sht', 'shyt',
        'bitch', 'btch', 'biatch',
        'cunt', 'cnt',
        'asshole', 'ashole', 'ahole',
        'pussy',
        'whore', 'whor',
        'slut', 'slt',
        
        // Offensive terms
        'bastard', 'bstrd',
        'damn', 'dmn',
        'piss', 'pis',
        'retard', 'retrd', 'retarded',
        'faggot', 'fag', 'fgt',
        'dyke', 'dyk',
        
        // Combinations
        'motherfucker', 'motherfker', 'mtherfucker',
        'cocksucker', 'cocksukr',
        'dickhead', 'dikhead',
        'shithead', 'shthead',
        
        // Additional offensive terms commonly used in sentences
        'idiot', 'moron', 'stupid', 'dumb', 'dumbass', 'dmbass',
        'loser', 'looser', 'lsr',
        'gay', 'homo', 'lesbian',
        'hell', 'hll',
        'crap', 'crp',
        'garbage', 'trash', 'bullshit', 'bulls***', 'bs',
        
        // Common substitutions and variations
        'stpd', 'stp1d', 'st4pid', 'stup1d',
        'dmb', 'd4mb', 'dumb@ss',
        'cr@p', 'crp', 'cr4p',
        'g@rb@ge', 'g4rb4ge',
        'h3ll', 'h@ll',
        'g@y', 'g4y',
        'hom0', 'h0mo',
    ],

    'bypass_patterns' => [
        // Patterns for words with excessive spacing/punctuation
        '/n[\s\.\*\-_]*i[\s\.\*\-_]*g[\s\.\*\-_]*g[\s\.\*\-_]*e[\s\.\*\-_]*r/i',
        '/f[\s\.\*\-_]*u[\s\.\*\-_]*c[\s\.\*\-_]*k/i',
        '/s[\s\.\*\-_]*h[\s\.\*\-_]*i[\s\.\*\-_]*t/i',
        '/b[\s\.\*\-_]*i[\s\.\*\-_]*t[\s\.\*\-_]*c[\s\.\*\-_]*h/i',
        '/a[\s\.\*\-_]*s[\s\.\*\-_]*s[\s\.\*\-_]*h[\s\.\*\-_]*o[\s\.\*\-_]*l[\s\.\*\-_]*e/i',
        
        // Additional patterns for sentence-level obfuscation
        '/\bf[\*\.\-_\s]*u[\*\.\-_\s]*c[\*\.\-_\s]*k/i',
        '/\bs[\*\.\-_\s]*h[\*\.\-_\s]*i[\*\.\-_\s]*t/i',
        '/\bd[\*\.\-_\s]*a[\*\.\-_\s]*m[\*\.\-_\s]*n/i',
        '/\bh[\*\.\-_\s]*e[\*\.\-_\s]*l[\*\.\-_\s]*l/i',
        '/\bc[\*\.\-_\s]*r[\*\.\-_\s]*a[\*\.\-_\s]*p/i',
        '/\bg[\*\.\-_\s]*a[\*\.\-_\s]*y/i',
        '/\br[\*\.\-_\s]*e[\*\.\-_\s]*t[\*\.\-_\s]*a[\*\.\-_\s]*r[\*\.\-_\s]*d/i',
        '/\bi[\*\.\-_\s]*d[\*\.\-_\s]*i[\*\.\-_\s]*o[\*\.\-_\s]*t/i',
        '/\bm[\*\.\-_\s]*o[\*\.\-_\s]*r[\*\.\-_\s]*o[\*\.\-_\s]*n/i',
        '/\bs[\*\.\-_\s]*t[\*\.\-_\s]*u[\*\.\-_\s]*p[\*\.\-_\s]*i[\*\.\-_\s]*d/i',
        
        // Patterns for leetspeak variations
        '/\bf[4@]ck/i',
        '/\bsh[1i]t/i',
        '/\bd[4@]mn/i',
        '/\bh[3e]ll/i',
        '/\bg[4@]y/i',
        '/\b[4@]ssh[0o]l[3e]/i',
        '/\bb[1i]tch/i',
        '/\bc[0o]ck/i',
        '/\bd[1i]ck/i',
        
        // Patterns for distributed words
        '/f\s*u\s*c\s*k/i',
        '/s\s*h\s*i\s*t/i',
        '/b\s*i\s*t\s*c\s*h/i',
        '/a\s*s\s*s\s*h\s*o\s*l\s*e/i',
    ],

    'normalization_rules' => [
        // Numbers to letters
        '4' => 'a',
        '3' => 'e',
        '1' => 'i',
        '|' => 'i',
        '0' => 'o',
        '5' => 's',
        '7' => 't',
        '8' => 'b',
        '6' => 'g',
        '9' => 'g',
        '2' => 'z',
        
        // Symbols to letters
        '@' => 'a',
        '!' => 'i',
        '\$' => 's',
        '+' => 't',
        '€' => 'e',
        '&' => 'a',
        '£' => 'l',
        '#' => 'h',
        '%' => 'x',
        '^' => 'a',
        
        // Common visual substitutions
        'ph' => 'f',
        'ck' => 'k',
        
        // Unicode look-alikes
        'ſ' => 's', // long s
        'ë' => 'e',
        'ü' => 'u',
        'ö' => 'o',
        'á' => 'a',
        'é' => 'e',
        'í' => 'i',
        'ó' => 'o',
        'ú' => 'u',
        'ä' => 'a',
        'ő' => 'o',
        'ű' => 'u',
        'č' => 'c',
        'š' => 's',
        'ž' => 'z',
        
        // Additional substitutions
        'vv' => 'w',
        'kk' => 'ck',
        'xx' => 'ck',
    ],

    'detection_thresholds' => [
        'symbol_density_max' => 0.4, // Max ratio of symbols to text length
        'min_encoded_length' => 20,  // Minimum length to consider for encoded content
    ],

];