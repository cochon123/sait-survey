@extends('layouts.app')

@section('content')
<div class="min-h-screen depth-layer-1">
    <!-- Hero Section -->
    <section class="text-center py-16 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Logo and Title -->
            <div class="flex items-center justify-center mb-8">
                <img src="{{ asset('image/campus_voice.png') }}" alt="Campus Voice Logo" class="h-16 w-auto mr-6 rounded-xl">
                <div class="text-left">
                    <h1 class="text-5xl font-bold text-primary mb-2">Campus Voice</h1>
                    <p class="text-lg text-muted">Your voice shapes the future</p>
                </div>
            </div>

            <p class="text-xl text-muted mb-12 max-w-3xl mx-auto">Help us shape the future of SAIT by sharing your ideas and feedback. Together, we can make our campus an even better place to learn and thrive.</p>

            <div class="space-x-4 flex justify-center flex-wrap gap-4">
                <a href="{{ route('propositions.index') }}" class="btn-secondary rounded-xl">View Ideas</a>
                @guest
                    <a href="{{ route('register') }}" class="btn-primary rounded-xl">Join Now</a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="frosted-card p-8 rounded-2xl">
                <h2 class="text-3xl font-bold text-primary text-center mb-12">Why Your Ideas Matter</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center p-6 frosted-input rounded-xl">
                        <div class="depth-layer-3 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-primary mb-3">Share Ideas</h3>
                        <p class="text-muted">Submit your creative suggestions to improve campus life for everyone.</p>
                    </div>
                    <div class="text-center p-6 frosted-input rounded-xl">
                        <div class="depth-layer-3 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-primary mb-3">Vote & Engage</h3>
                        <p class="text-muted">Support the ideas you believe in by voting and engaging with the community.</p>
                    </div>
                    <div class="text-center p-6 frosted-input rounded-xl">
                        <div class="depth-layer-3 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-primary mb-3">See Real Change</h3>
                        <p class="text-muted">Watch as your suggestions are implemented to make SAIT even better.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="frosted-card p-8 rounded-2xl">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="p-4 rounded-lg">
                        <div class="text-3xl font-bold text-brand mb-2">150+</div>
                        <div class="text-muted">Student Ideas</div>
                    </div>
                    <div class="p-4 rounded-lg">
                        <div class="text-3xl font-bold text-brand mb-2">50+</div>
                        <div class="text-muted">Active Students</div>
                    </div>
                    <div class="p-4 rounded-lg">
                        <div class="text-3xl font-bold text-brand mb-2">25+</div>
                        <div class="text-muted">Ideas Implemented</div>
                    </div>
                    <div class="p-4 rounded-lg">
                        <div class="text-3xl font-bold text-brand mb-2">100%</div>
                        <div class="text-muted">Community Driven</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Campus Images Grid -->
    <section class="py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="frosted-card p-8 rounded-2xl">
                <h2 class="text-3xl font-bold text-primary text-center mb-12">Our SAIT Community</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="order-2 md:order-1">
                        <div class="frosted-input p-6 rounded-2xl overflow-hidden">
                            <img src="{{ asset('image/students-speaking-with-an-instructor-at-sait.jpg') }}" alt="Students with Instructor" class="w-full h-64 object-cover rounded-xl">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-primary mb-2">Expert Faculty</h3>
                                <p class="text-muted">Learn from industry professionals and experienced educators.</p>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 md:order-2">
                        <p class="text-xl text-primary mb-6">We want to know what students need to build products meaningful for them.</p>
                        <p class="text-lg text-muted mb-8">If you want to actively take part of the project <a href="{{ route('join') }}" class="text-brand underline underline-offset-4 hover:no-underline transition-all">just click here</a>. But do not feel obligated. Submitting your ideas already means a lot for us.</p>
                        <a href="{{ route('propositions.index') }}" class="btn-primary rounded-xl">View Propositions</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Propositions Preview -->
    <section class="py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="frosted-card p-8 rounded-2xl">
                <h2 class="text-3xl font-bold text-primary text-center mb-12">Recent Student Ideas</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="frosted-input p-6 rounded-xl">
                        <h3 class="text-xl font-semibold text-primary mb-3">Better Food Options</h3>
                        <p class="text-muted mb-6">More diverse and healthier food choices in the cafeteria would greatly improve our daily experience.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-muted">Posted by Anonymous</span>
                            <div class="flex items-center space-x-3">
                                <button class="flex items-center space-x-1 text-green-500 hover:text-green-400 transition-colors rounded-lg px-2 py-1">
                                    <span>👍</span><span class="text-sm">24</span>
                                </button>
                                <button class="flex items-center space-x-1 text-red-500 hover:text-red-400 transition-colors rounded-lg px-2 py-1">
                                    <span>👎</span><span class="text-sm">2</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="frosted-input p-6 rounded-xl">
                        <h3 class="text-xl font-semibold text-primary mb-3">Extended Library Hours</h3>
                        <p class="text-muted mb-6">Keeping the library open later would help students with evening classes and study groups.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-muted">Posted by Anonymous</span>
                            <div class="flex items-center space-x-3">
                                <button class="flex items-center space-x-1 text-green-500 hover:text-green-400 transition-colors rounded-lg px-2 py-1">
                                    <span>👍</span><span class="text-sm">18</span>
                                </button>
                                <button class="flex items-center space-x-1 text-red-500 hover:text-red-400 transition-colors rounded-lg px-2 py-1">
                                    <span>👎</span><span class="text-sm">1</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="frosted-input p-6 rounded-xl">
                        <h3 class="text-xl font-semibold text-primary mb-3">More Study Spaces</h3>
                        <p class="text-muted mb-6">Additional quiet study areas would be beneficial for focused learning and group projects.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-muted">Posted by Anonymous</span>
                            <div class="flex items-center space-x-3">
                                <button class="flex items-center space-x-1 text-green-500 hover:text-green-400 transition-colors rounded-lg px-2 py-1">
                                    <span>👍</span><span class="text-sm">31</span>
                                </button>
                                <button class="flex items-center space-x-1 text-red-500 hover:text-red-400 transition-colors rounded-lg px-2 py-1">
                                    <span>👎</span><span class="text-sm">3</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-12">
                    <a href="{{ route('propositions.index') }}" class="btn-secondary rounded-xl">View All Propositions</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="frosted-card p-12 text-center rounded-2xl">
                <h2 class="text-3xl font-bold text-primary mb-4">Have an Idea?</h2>
                <p class="text-xl text-muted mb-8">Share your thoughts and help make SAIT an even better place to learn and grow.</p>
                <a href="{{ route('propositions.index') }}" class="btn-primary rounded-xl">Submit Your Idea</a>
            </div>
        </div>
    </section>
</div>
@endsection