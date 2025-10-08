<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test de Modération - Campus Voice</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="depth-layer-1 min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-primary mb-8">Test du Système de Modération</h1>
        
        @auth
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Test Pseudonyme -->
                <div class="frosted-card p-6">
                    <h2 class="text-xl font-semibold text-primary mb-4">Test Pseudonyme</h2>
                    <form id="test-nickname-form">
                        <input type="text" id="test-nickname" placeholder="Testez un pseudonyme..." class="form-input w-full mb-4">
                        <button type="submit" class="btn-primary w-full">Tester</button>
                    </form>
                    <div id="nickname-result" class="mt-4 text-sm"></div>
                </div>

                <!-- Test Proposition -->
                <div class="frosted-card p-6">
                    <h2 class="text-xl font-semibold text-primary mb-4">Test Proposition</h2>
                    <form id="test-proposition-form">
                        <textarea id="test-proposition" placeholder="Testez une proposition..." class="form-input w-full mb-4" rows="3"></textarea>
                        <button type="submit" class="btn-primary w-full">Tester</button>
                    </form>
                    <div id="proposition-result" class="mt-4 text-sm"></div>
                </div>

                <!-- Test Commentaire -->
                <div class="frosted-card p-6">
                    <h2 class="text-xl font-semibold text-primary mb-4">Test Commentaire</h2>
                    <form id="test-comment-form">
                        <input type="text" id="test-comment" placeholder="Testez un commentaire..." class="form-input w-full mb-4">
                        <button type="submit" class="btn-primary w-full">Tester</button>
                    </form>
                    <div id="comment-result" class="mt-4 text-sm"></div>
                </div>
            </div>

            <!-- Exemples de contenu à tester -->
            <div class="frosted-card p-6 mt-8">
                <h2 class="text-xl font-semibold text-primary mb-4">Exemples de Contenu à Tester</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-medium text-primary mb-2">Contenu Acceptable</h3>
                        <ul class="text-sm text-text-muted space-y-1">
                            <li>"Nous devrions avoir plus d'options végétariennes"</li>
                            <li>"La bibliothèque devrait être ouverte plus tard"</li>
                            <li>"Excellente idée, je suis d'accord !"</li>
                            <li>"Je pense que c'est une mauvaise idée"</li>
                            <li>"CoolUser123"</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-medium text-primary mb-2">Contenu à Surveiller</h3>
                        <ul class="text-sm text-text-muted space-y-1">
                            <li>"Tu es vraiment stupide"</li>
                            <li>"Les [groupe] sont tous pareils"</li>
                            <li>"Je vais te retrouver"</li>
                            <li>"Contenu explicite sexuel"</li>
                            <li>"MotOffensant2024"</li>
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <div class="frosted-card p-8 text-center">
                <h2 class="text-xl font-semibold text-primary mb-4">Authentification Requise</h2>
                <p class="text-text-muted mb-6">Vous devez être connecté pour tester le système de modération.</p>
                <a href="{{ route('login') }}" class="btn-primary">Se Connecter</a>
            </div>
        @endauth
    </div>

    @include('components.moderation-popup')

    <script src="{{ asset('js/moderation.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Test du pseudonyme
            document.getElementById('test-nickname-form').addEventListener('submit', async function(e) {
                e.preventDefault();
                const input = document.getElementById('test-nickname');
                const result = document.getElementById('nickname-result');
                
                if (!input.value.trim()) return;
                
                result.innerHTML = '<span class="text-yellow-600">🔄 Vérification...</span>';
                
                try {
                    const moderationResult = await window.moderationService.checkNickname(input.value.trim());
                    
                    if (moderationResult.approved) {
                        result.innerHTML = '<span class="text-green-600">✅ Pseudonyme accepté</span>';
                    } else {
                        result.innerHTML = `<span class="text-red-600">❌ Pseudonyme rejeté</span><br><small>${moderationResult.reason}</small>`;
                    }
                } catch (error) {
                    result.innerHTML = '<span class="text-red-600">❌ Moderation Error</span>';
                }
            });

            // Test de la proposition
            document.getElementById('test-proposition-form').addEventListener('submit', async function(e) {
                e.preventDefault();
                const input = document.getElementById('test-proposition');
                const result = document.getElementById('proposition-result');
                
                if (!input.value.trim()) return;
                
                result.innerHTML = '<span class="text-yellow-600">🔄 Vérification...</span>';
                
                try {
                    const moderationResult = await window.moderationService.checkProposition(input.value.trim());
                    
                    if (moderationResult.approved) {
                        result.innerHTML = '<span class="text-green-600">✅ Proposition acceptée</span>';
                    } else {
                        result.innerHTML = `<span class="text-red-600">❌ Proposition rejetée</span><br><small>${moderationResult.reason}</small>`;
                    }
                } catch (error) {
                    result.innerHTML = '<span class="text-red-600">❌ Moderation Error</span>';
                }
            });

            // Test du commentaire
            document.getElementById('test-comment-form').addEventListener('submit', async function(e) {
                e.preventDefault();
                const input = document.getElementById('test-comment');
                const result = document.getElementById('comment-result');
                
                if (!input.value.trim()) return;
                
                result.innerHTML = '<span class="text-yellow-600">🔄 Vérification...</span>';
                
                try {
                    const moderationResult = await window.moderationService.checkComment(input.value.trim());
                    
                    if (moderationResult.approved) {
                        result.innerHTML = '<span class="text-green-600">✅ Commentaire accepté</span>';
                    } else {
                        result.innerHTML = `<span class="text-red-600">❌ Commentaire rejeté</span><br><small>${moderationResult.reason}</small>`;
                    }
                } catch (error) {
                    result.innerHTML = '<span class="text-red-600">❌ Moderation Error</span>';
                }
            });
        });
    </script>
</body>
</html>