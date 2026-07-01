@extends('layouts.app')

@section('title', 'Press & Media - M3alam')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Press & Media</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Stay updated with the latest news, announcements, and media coverage about M3alam.
        </p>
    </div>

    <!-- Press Kit -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-center mb-8">Press Kit</h2>
        <div class="bg-white border border-gray-200 rounded-lg p-8 shadow-sm">
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Company Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="font-medium text-gray-700">Founded:</span>
                            <span class="text-gray-600">2024</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Headquarters:</span>
                            <span class="text-gray-600">Morocco</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Industry:</span>
                            <span class="text-gray-600">Task-based Services Platform</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Mission:</span>
                            <span class="text-gray-600">Connecting people who need tasks done with skilled taskers in their community</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Media Resources</h3>
                    <div class="space-y-3">
                        <a href="#" class="block bg-blue-50 hover:bg-blue-100 p-3 rounded-lg transition duration-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="text-blue-700 font-medium">Download Logo Pack</span>
                            </div>
                        </a>
                        <a href="#" class="block bg-blue-50 hover:bg-blue-100 p-3 rounded-lg transition duration-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-blue-700 font-medium">High-Resolution Images</span>
                            </div>
                        </a>
                        <a href="#" class="block bg-blue-50 hover:bg-blue-100 p-3 rounded-lg transition duration-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="text-blue-700 font-medium">Company Fact Sheet</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest News -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-center mb-8">Latest News</h2>
        <div class="space-y-6">
            <!-- News Item 1 -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium mb-2 inline-block">Press Release</span>
                        <h3 class="text-xl font-semibold text-gray-900">M3alam Launches Revolutionary Task-Based Services Platform</h3>
                        <p class="text-gray-600 text-sm">January 15, 2024</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">
                    M3alam today announced the launch of its innovative platform that connects individuals and businesses with skilled taskers for a wide range of services, from home repairs to digital marketing.
                </p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read Full Article →</a>
            </div>

            <!-- News Item 2 -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium mb-2 inline-block">Media Coverage</span>
                        <h3 class="text-xl font-semibold text-gray-900">TechCrunch Features M3alam as Rising Startup to Watch</h3>
                        <p class="text-gray-600 text-sm">December 20, 2023</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">
                    Leading technology publication TechCrunch highlights M3alam's innovative approach to the gig economy and its potential to transform how people access services.
                </p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read Full Article →</a>
            </div>

            <!-- News Item 3 -->
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium mb-2 inline-block">Award</span>
                        <h3 class="text-xl font-semibold text-gray-900">M3alam Wins Best Innovation Award at Startup Summit 2023</h3>
                        <p class="text-gray-600 text-sm">November 10, 2023</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">
                    M3alam was recognized for its outstanding contribution to the digital services industry at the annual Startup Summit, competing against over 200 innovative companies.
                </p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Read Full Article →</a>
            </div>
        </div>
    </div>

    <!-- Media Coverage -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-center mb-8">Media Coverage</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-lg mx-auto mb-4 flex items-center justify-center">
                    <span class="text-2xl font-bold text-gray-600">TC</span>
                </div>
                <h4 class="font-semibold mb-2">TechCrunch</h4>
                <p class="text-sm text-gray-600 mb-3">"M3alam is revolutionizing the way people access local services"</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">Read Article</a>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-lg mx-auto mb-4 flex items-center justify-center">
                    <span class="text-2xl font-bold text-gray-600">VB</span>
                </div>
                <h4 class="font-semibold mb-2">VentureBeat</h4>
                <p class="text-sm text-gray-600 mb-3">"The future of gig economy platforms"</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">Read Article</a>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-lg mx-auto mb-4 flex items-center justify-center">
                    <span class="text-2xl font-bold text-gray-600">FT</span>
                </div>
                <h4 class="font-semibold mb-2">Financial Times</h4>
                <p class="text-sm text-gray-600 mb-3">"Disrupting traditional service industries"</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">Read Article</a>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-center mb-8">By the Numbers</h2>
        <div class="grid md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">10K+</div>
                <p class="text-gray-600">Active Users</p>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">5K+</div>
                <p class="text-gray-600">Completed Tasks</p>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-purple-600 mb-2">50+</div>
                <p class="text-gray-600">Service Categories</p>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-orange-600 mb-2">98%</div>
                <p class="text-gray-600">Customer Satisfaction</p>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="bg-gray-50 rounded-lg p-8 text-center">
        <h2 class="text-2xl font-bold mb-4">Media Inquiries</h2>
        <p class="text-gray-600 mb-6">
            For press inquiries, interviews, or additional information, please contact our media team.
        </p>
        <div class="space-y-2">
            <p class="text-gray-700">
                <span class="font-medium">Email:</span> press@m3alam.com
            </p>
            <p class="text-gray-700">
                <span class="font-medium">Phone:</span> +212 5XX-XXX-XXX
            </p>
        </div>
        <div class="mt-6">
            // Line 194: Update contact link
            <a href="{{ localized_route('contact') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 inline-block">
                Contact Media Team
            </a>
        </div>
    </div>
</div>
@endsection