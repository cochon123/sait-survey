@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    <!-- Hero Section -->
    <section class="text-center py-16">
        <h1 class="text-5xl font-bold text-blue-900 mb-6">SAIT Student Survey</h1>
        <p class="text-xl text-gray-700 mb-8 max-w-3xl mx-auto">Your voice matters! Help us shape the future of SAIT by sharing your ideas and feedback. Together, we can make our campus an even better place to learn and thrive.</p>
        <div class="space-x-4">
            <a href="{{ route('propositions.index') }}" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition duration-300 text-lg font-medium">View Ideas</a>
            @guest
                <a href="{{ route('register') }}" class="bg-yellow-500 text-blue-900 px-8 py-4 rounded-lg hover:bg-yellow-400 transition duration-300 text-lg font-medium">Join Now</a>
            @endguest
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-blue-900 text-center mb-12">Why Your Ideas Matter</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-3">Share Ideas</h3>
                    <p class="text-gray-600">Submit your creative suggestions to improve campus life for everyone.</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-3">Vote & Engage</h3>
                    <p class="text-gray-600">Support the ideas you believe in by voting and engaging with the community.</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-3">See Real Change</h3>
                    <p class="text-gray-600">Watch as your suggestions are implemented to make SAIT even better.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl font-bold text-blue-900 mb-2">150+</div>
                    <div class="text-gray-600">Student Ideas</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-blue-900 mb-2">50+</div>
                    <div class="text-gray-600">Active Students</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-blue-900 mb-2">25+</div>
                    <div class="text-gray-600">Ideas Implemented</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-blue-900 mb-2">100%</div>
                    <div class="text-gray-600">Community Driven</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Campus Images Grid -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-blue-900 text-center mb-12">Our SAIT Community</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                <div class="order-2 lg:order-1 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ asset('image/students-speaking-with-an-instructor-at-sait.jpg') }}" alt="Students with Instructor" class="w-full h-64 object-cover">
                    <div class="p-4 bg-white">
                        <h3 class="text-lg font-semibold text-blue-900">Expert Faculty</h3>
                        <p class="text-gray-600">Learn from industry professionals and experienced educators.</p>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <p class="text-xl text-gray-700 mb-6">We want to know what students need to build products meaningful for them.</p>
                </div>
            </div>

            <div class="text-center mb-12 mt-8">
                <p class="text-xl text-gray-700 mb-6 max-w-3xl mx-auto">If you want to actively take part of the project <a href="{{ route('join') }}" class="text-blue-600 underline">just click here</a>. But do not feel obligated. Submitting your ideas already mean a lot for us. We will do our best to transform your ideas into reality. We believe in project build by community.</p>
                <a href="{{ route('propositions.index') }}" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition duration-300 text-lg font-medium">View Propositions</a>
            </div>
        </div>
    </section>

    <!-- Recent Propositions Preview -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-blue-900 text-center mb-8">Recent Student Ideas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-blue-900 mb-3">Better Food Options</h3>
                    <p class="text-gray-600 mb-4">More diverse and healthier food choices in the cafeteria would greatly improve our daily experience.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Posted by Anonymous</span>
                        <div class="flex items-center space-x-2">
                            <button class="text-green-600 hover:text-green-800">👍 24</button>
                            <button class="text-red-600 hover:text-red-800">👎 2</button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-blue-900 mb-3">Extended Library Hours</h3>
                    <p class="text-gray-600 mb-4">Keeping the library open later would help students with evening classes and study groups.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Posted by Anonymous</span>
                        <div class="flex items-center space-x-2">
                            <button class="text-green-600 hover:text-green-800">👍 18</button>
                            <button class="text-red-600 hover:text-red-800">👎 1</button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-blue-900 mb-3">More Study Spaces</h3>
                    <p class="text-gray-600 mb-4">Additional quiet study areas would be beneficial for focused learning and group projects.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Posted by Anonymous</span>
                        <div class="flex items-center space-x-2">
                            <button class="text-green-600 hover:text-green-800">👍 31</button>
                            <button class="text-red-600 hover:text-red-800">👎 3</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('propositions.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">View All Propositions</a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Have an Idea?</h2>
            <p class="text-xl mb-6">Share your thoughts and help make SAIT an even better place to learn and grow.</p>
            <a href="{{ route('propositions.index') }}" class="bg-yellow-500 text-blue-900 px-8 py-4 rounded-lg hover:bg-yellow-400 transition duration-300 text-lg font-medium">Submit Your Idea</a>
        </div>
    </section>
</div>
@endsection