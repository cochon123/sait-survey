<!-- Instructions concises pour les agents IA qui contribuent à ce dépôt -->
# Instructions pour l'agent Copilot (sait-survey)

Ces instructions sont destinées à un agent automatisé ou assistant (Copilot-like) qui modifie et teste le code de cette application Laravel (Campus Voice).

1. Vue d'ensemble rapide
- Backend: Laravel 11 (PHP >= 8.2). Frontend: Tailwind CSS + JS (Vite). DB principale MySQL, SQLite pour tests.
- But: application mobile-first de propositions + votes + commentaires. Modération AI intégrée via Gemini.

2. Points d'entrée importants
- Routes principales: `routes/web.php`, `routes/auth.php` (contrôleurs: `app/Http/Controllers/*`).
- Modération: `app/Services/ContentModerationService.php` (logic d'escalade LLM et heuristiques).
- Assets JS: sources dans `resources/js/`, version servie rapide en `public/js/moderation.js` (copy temporaire).
- Vues critiques: `resources/views/propositions/*` (formulaires, partials, scripts inclus).

3. Workflows et commandes courants
- Installer: `composer install && npm install` (déjà présent dans README).
- Migrations & seed: `php artisan migrate --seed`.
- Tests unit/feature: `./vendor/bin/phpunit` ou via IDE task; certains tests utilisent SQLite dans `phpunit.xml`.
- Ne pas lancer `php artisan serve` ou `npm run dev` si déjà fournis par l'environnement (voir `.github/instructions/project.instructions.md`).

4. Conventions et patterns spécifiques au projet
- Modération: pipeline en deux étapes — heuristiques rapides (normalisation/regex) puis appel Gemini. En cas d'obfuscation on escalade au modèle `models/gemini-flash-lite-latest`.
- Validation: le projet préfère laisser la modération décider des contenus ponctués/obfusqués, donc éviter de rejeter via des regex trop strictes (ex.: `CommentController::store` et `PropositionController::store` ont été relaxés).
- PWA: manifeste et service worker via `vite-plugin-pwa` (voir `manifest.webmanifest`, `sw.js`).

5. Intégrations externes et exigences de sécurité
- Gemini LLM: usages via `Gemini\\Laravel\Facades\Gemini` (vérifier les appels dans `ContentModerationService`).
- Codacy / Trivy: lorsque vous modifiez des fichiers, l'instruction projet exige d'exécuter l'analyse Codacy locale (voir `.github/instructions/codacy.instructions.md`). Si l'outil n'est pas disponible, demandez avant d'installer.

6. Exemples concrets à suivre
- Ajouter un endpoint de modération: suivre la forme de `ModerationController` (validation légère → appeler `ContentModerationService::moderate*` → renvoyer JSON { decision, reasoning }).
- JS client: `resources/js/moderation.js` expose `window.moderation` et lit `window.APP_DEBUG` (déclaré dans `resources/views/propositions/partials/_scripts.blade.php`) pour logs conditionnels.

6.1 Exemples rapides
- Vérifier les endpoints de modération (feature tests): `./vendor/bin/phpunit tests/Feature/ModerationControllerTest.php`
- Exécuter les migrations de test et seed rapides: `php artisan migrate --seed --env=testing`
- Emuler une requête de modération côté serveur (télécharger le payload depuis les logs ou reproduire): regardez `storage/logs/laravel.log` pour exemples de prompts envoyés au modèle.

6.2 Note Codacy obligatoire
- La politique projet exige d'exécuter l'analyse Codacy locale après toute modification de fichiers (voir `.github/instructions/codacy.instructions.md`). Si la CLI Codacy n'est pas installée dans l'environnement, demande explicitement l'autorisation avant d'installer des outils externes.

7. Tests & qualité
- Après modifications de code exécuter au minimum les tests feature liés: `tests/Feature/ModerationControllerTest.php` et les tests de propositions/commentaires.
- Respecter les règles de l'instruction de commit propre: supprimer `dd()`, `dump()`, `console.log()` avant commit.

8. Limitations et choses à ne pas inventer
- Ne pas modifier les secrets ni pousser de clés dans le repo. Le dossier `.ssh` est ignoré.
- Éviter d'exécuter des commandes longues (build watch) sans prévenir — l'environnement peut déjà avoir des serveurs en watch.

9. Si tu changes des fichiers
- Mettre à jour la documentation minimale (README ou note dans `.github/`) si tu modifies un workflow.
- Exécuter les tests unitaires/feature pertinents et signaler les résultats.

10. Demande de retour
- Si un point est ambigu (par ex. politique de modération exacte, modèle à utiliser en production), demande une confirmation humaine avant d'imposer un changement.

---
Si tu veux, je peux maintenant (1) fusionner ces instructions dans un fichier existant `.github/copilot-instructions.md` (s'il existe), ou (2) ajouter ci-dessus tel quel dans le repo. Quelle option préfères-tu ?
