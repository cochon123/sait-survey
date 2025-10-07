<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('propositions.partials._head')
    <body class="depth-layer-1 min-h-screen pb-24">
        <!-- Main Content -->
        <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @include('propositions.partials._header')
            @include('propositions.partials._form')
            @include('propositions.partials._sorting')
            @include('propositions.partials._list')
        </main>

        @include('propositions.partials._footer')
        @include('propositions.partials._modals')
        @include('components.bottom-navigation')
        @include('propositions.partials._scripts')
    </body>
</html>