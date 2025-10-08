# Content Moderation System - Anti-Bypass Improvements

## Overview

The content moderation system has been significantly enhanced to prevent bypass attempts using obfuscated words, leetspeak, and other evasion techniques.

## Key Improvements

### 1. Enhanced Normalization
The system now normalizes text by:
- Converting to lowercase
- Replacing common leetspeak substitutions (4→a, 3→e, 1→i, 0→o, etc.)
- Removing punctuation, spaces, and special characters
- Collapsing repeated characters

**Examples blocked:**
- `f*u*c*k` → normalized to `fuck`
- `n.i.g.g.e.r` → normalized to `nigger`
- `sh1t` → normalized to `shit`
- `@$$hole` → normalized to `asshole`

### 2. Comprehensive Banned Words List
Expanded banned words list includes:
- Racial slurs and variants
- Profanity and variants
- Common abbreviations and misspellings
- Configurable via `config/moderation.php`

### 3. Pattern-Based Detection
Regex patterns catch:
- Words with excessive spacing: `f u c k`
- Words with punctuation: `f.u.c.k`
- Mixed obfuscation methods

### 4. Advanced Bypass Detection
Additional checks for:
- High symbol density (>40% special characters)
- Excessive character spacing
- Potential Base64/hex encoded content

### 5. Configuration-Driven
All rules are externalized to `config/moderation.php`:
- Banned words list
- Normalization rules
- Bypass patterns
- Detection thresholds

## How It Works

1. **Pre-Check Phase**: Before AI moderation, content goes through:
   - Obfuscated word detection
   - Advanced bypass detection
   - Early rejection if violations found

2. **AI Phase**: If pre-checks pass, content is analyzed by Gemini AI

3. **Logging**: All detections are logged for monitoring and improvement

## Testing

Run tests with:
```bash
php artisan test tests/Unit/ContentModerationTest.php
```

## Configuration

Edit `/config/moderation.php` to:
- Add/remove banned words
- Adjust normalization rules
- Modify detection thresholds
- Add new bypass patterns

## Examples

### Blocked Content
- `f*u*c*k you`
- `n.i.g.g.e.r`
- `sh1t post`
- `4sshole`
- `b!tch`
- `************************` (high symbol density)
- `f   u   c   k` (excessive spacing)

### Allowed Content
- `This is a great idea`
- `I think we need better food`
- `Campus WiFi needs improvement`

## Monitoring

Check Laravel logs for:
- `Obfuscated banned word detected`
- `Advanced bypass attempt detected`
- `Pattern detection`
- `High symbol density detected`