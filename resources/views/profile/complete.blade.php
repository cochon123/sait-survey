<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Complete Your Profile</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .frosted-card {
            max-width: 400px;
            width: 100%;
        }
    </style>
</head>
<body class="depth-layer-1">
    <div class="frosted-card p-8">
        <h1 class="text-2xl font-bold text-primary mb-4">Choose Your Nickname</h1>
        <p class="text-muted mb-6">
            Welcome! To participate in the community, please choose a nickname. This will be your public identity on Campus Voice.
        </p>

        <form id="nickname-form" action="{{ route('profile.complete.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nickname" class="block text-sm font-medium text-primary mb-2">Nickname</label>
                <input type="text" id="nickname" name="nickname" class="form-input w-full" value="{{ old('nickname', Auth::user()->name) }}" required autofocus>
                @error('nickname')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-primary w-full">Save and Continue</button>
        </form>
    </div>

    @include('components.moderation-popup')

    <script src="{{ asset('js/moderation.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nicknameForm = document.getElementById('nickname-form');
            
            if (nicknameForm) {
                moderateFormSubmission(
                    nicknameForm,
                    'nickname',
                    (form) => {
                        const input = form.querySelector('#nickname');
                        return {
                            nickname: input.value.trim()
                        };
                    },
                    (form, data) => {
                        // Contenu approuvé : soumettre le formulaire normalement
                        form.submit();
                    }
                );
            }
        });
    </script>
</body>
</html>
