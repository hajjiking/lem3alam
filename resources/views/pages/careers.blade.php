@extends('layouts.app')

@section('title', 'Careers - Join Our Team')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Join Our Team</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Help us build the future of task-based services. We're looking for passionate individuals who want to make a difference.
        </p>
    </div>

    <!-- Why Work With Us -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-center mb-8">Why Work With Us?</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Innovation</h3>
                <p class="text-gray-600">Work on cutting-edge technology that connects people and creates opportunities.</p>
            </div>
            <div class="text-center">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Growth</h3>
                <p class="text-gray-600">Continuous learning opportunities and career advancement in a growing company.</p>
            </div>
            <div class="text-center">
                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Impact</h3>
                <p class="text-gray-600">Make a real difference in people's lives by helping them accomplish their tasks.</p>
            </div>
        </div>
    </div>

    <!-- Open Positions -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-center mb-8">Open Positions</h2>
        <div class="space-y-6">
            <!-- Software Engineer -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">Senior Software Engineer</h3>
                        <p class="text-gray-600">Engineering • Full-time • Remote</p>
                    </div>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">New</span>
                </div>
                <p class="text-gray-700 mb-4">
                    Join our engineering team to build scalable web applications using Laravel, Vue.js, and modern technologies.
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">Laravel</span>
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">Vue.js</span>
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">MySQL</span>
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">AWS</span>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                    Apply Now
                </button>
            </div>

            <!-- Product Manager -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">Product Manager</h3>
                        <p class="text-gray-600">Product • Full-time • Hybrid</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">
                    Lead product strategy and development for our task marketplace platform.
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Product Strategy</span>
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">User Research</span>
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Analytics</span>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                    Apply Now
                </button>
            </div>

            <!-- UX Designer -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">UX/UI Designer</h3>
                        <p class="text-gray-600">Design • Full-time • Remote</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">
                    Create intuitive and beautiful user experiences for our web and mobile applications.
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">Figma</span>
                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">User Research</span>
                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">Prototyping</span>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                    Apply Now
                </button>
            </div>
        </div>
    </div>

    <!-- Benefits -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-center mb-8">Benefits & Perks</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h4 class="font-semibold mb-1">Health Insurance</h4>
                <p class="text-sm text-gray-600">Comprehensive medical coverage</p>
            </div>
            <div class="text-center">
                <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <h4 class="font-semibold mb-1">Competitive Salary</h4>
                <p class="text-sm text-gray-600">Market-rate compensation</p>
            </div>
            <div class="text-center">
                <div class="bg-yellow-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h4 class="font-semibold mb-1">Flexible Hours</h4>
                <p class="text-sm text-gray-600">Work-life balance</p>
            </div>
            <div class="text-center">
                <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h4 class="font-semibold mb-1">Learning Budget</h4>
                <p class="text-sm text-gray-600">Professional development</p>
            </div>
        </div>
    </div>

    <!-- Application Process -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-center mb-8">Application Process</h2>
        <div class="grid md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center mx-auto mb-4 font-bold">1</div>
                <h4 class="font-semibold mb-2">Apply</h4>
                <p class="text-sm text-gray-600">Submit your application and resume</p>
            </div>
            <div class="text-center">
                <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center mx-auto mb-4 font-bold">2</div>
                <h4 class="font-semibold mb-2">Screen</h4>
                <p class="text-sm text-gray-600">Initial phone/video screening</p>
            </div>
            <div class="text-center">
                <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center mx-auto mb-4 font-bold">3</div>
                <h4 class="font-semibold mb-2">Interview</h4>
                <p class="text-sm text-gray-600">Technical and cultural fit interviews</p>
            </div>
            <div class="text-center">
                <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center mx-auto mb-4 font-bold">4</div>
                <h4 class="font-semibold mb-2">Offer</h4>
                <p class="text-sm text-gray-600">Welcome to the team!</p>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="text-center bg-gray-50 rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-4">Don't See a Perfect Match?</h2>
        <p class="text-gray-600 mb-6">
            We're always looking for talented individuals. Send us your resume and tell us how you'd like to contribute.
        </p>
        // Line 196: Update contact link
        <a href="{{ localized_route('contact') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 inline-block">
            Get in Touch
        </a>
    </div>
</div>
@endsection