@extends('layouts.app')

@section('title', 'Blog - M3alam')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">M3alam Blog</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Insights, tips, and stories from the world of task-based services and the gig economy.
        </p>
    </div>

    <!-- Featured Post -->
    <div class="mb-16">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg overflow-hidden shadow-lg">
            <div class="md:flex">
                <div class="md:w-1/2">
                    <img
                        src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        srcset="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=480&q=75 480w, https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80 800w, https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80 1200w"
                        sizes="(max-width: 768px) 100vw, 50vw"
                        alt="Featured post"
                        class="w-full h-64 md:h-full object-cover"
                        loading="eager"
                        decoding="async"
                        fetchpriority="high"
                    >
                </div>
                <div class="md:w-1/2 p-8 text-white">
                    <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm font-medium mb-4 inline-block">Featured</span>
                    <h2 class="text-3xl font-bold mb-4">The Future of Task-Based Services: Trends to Watch in 2024</h2>
                    <p class="text-blue-100 mb-6">
                        Explore the emerging trends shaping the gig economy and how platforms like M3alam are revolutionizing the way people access services.
                    </p>
                    <div class="flex items-center mb-4">
                        <img
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&q=80"
                            srcset="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&q=80 40w, https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&q=80 80w, https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=120&q=80 120w"
                            sizes="40px"
                            alt="Author"
                            class="w-10 h-10 rounded-full mr-3"
                            loading="eager"
                            decoding="async"
                        >
                        <div>
                            <p class="font-medium">Sarah Johnson</p>
                            <p class="text-blue-200 text-sm">January 15, 2024</p>
                        </div>
                    </div>
                    <a href="#" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-medium hover:bg-blue-50 transition duration-200">
                        Read More
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Filter -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-3 justify-center">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium">All Posts</button>
            <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-200 transition duration-200">Tips & Guides</button>
            <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-200 transition duration-200">Success Stories</button>
            <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-200 transition duration-200">Industry News</button>
            <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-200 transition duration-200">Platform Updates</button>
        </div>
    </div>

    <!-- Blog Posts Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <!-- Blog Post 1 -->
        <article class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-200">
            <img
                src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                srcset="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=320&q=75 320w, https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80 400w, https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=640&q=80 640w"
                sizes="(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw"
                alt="Blog post"
                class="w-full h-48 object-cover"
                loading="lazy"
                decoding="async"
            >
            <div class="p-6">
                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium mb-3 inline-block">Tips & Guides</span>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    <a href="#" class="hover:text-blue-600 transition duration-200">10 Essential Tips for New Taskers</a>
                </h3>
                <p class="text-gray-600 mb-4">
                    Starting your journey as a tasker? Here are the essential tips to help you succeed and build a strong reputation on the platform.
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img
                            src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80"
                            srcset="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=32&q=80 32w, https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80 64w, https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=96&q=80 96w"
                            sizes="32px"
                            alt="Author"
                            class="w-8 h-8 rounded-full mr-2"
                            loading="lazy"
                            decoding="async"
                        >
                        <div>
                            <p class="text-sm font-medium text-gray-900">Emma Wilson</p>
                            <p class="text-xs text-gray-500">Jan 12, 2024</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">5 min read</span>
                </div>
            </div>
        </article>

        <!-- Blog Post 2 -->
        <article class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-200">
            <img
                src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                srcset="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=320&q=75 320w, https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80 400w, https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=640&q=80 640w"
                sizes="(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw"
                alt="Blog post"
                class="w-full h-48 object-cover"
                loading="lazy"
                decoding="async"
            >
            <div class="p-6">
                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium mb-3 inline-block">Success Stories</span>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    <a href="#" class="hover:text-blue-600 transition duration-200">How Ahmed Built a Thriving Handyman Business</a>
                </h3>
                <p class="text-gray-600 mb-4">
                    From occasional weekend jobs to a full-time business, discover how Ahmed leveraged M3alam to transform his career.
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img
                            src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80"
                            srcset="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=32&q=80 32w, https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80 64w, https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=96&q=80 96w"
                            sizes="32px"
                            alt="Author"
                            class="w-8 h-8 rounded-full mr-2"
                            loading="lazy"
                            decoding="async"
                        >
                        <div>
                            <p class="text-sm font-medium text-gray-900">Michael Chen</p>
                            <p class="text-xs text-gray-500">Jan 10, 2024</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">7 min read</span>
                </div>
            </div>
        </article>

        <!-- Blog Post 3 -->
        <article class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-200">
            <img
                src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                srcset="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=320&q=75 320w, https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80 400w, https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=640&q=80 640w"
                sizes="(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw"
                alt="Blog post"
                class="w-full h-48 object-cover"
                loading="lazy"
                decoding="async"
            >
            <div class="p-6">
                <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-medium mb-3 inline-block">Industry News</span>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    <a href="#" class="hover:text-blue-600 transition duration-200">The Rise of Digital Services in Morocco</a>
                </h3>
                <p class="text-gray-600 mb-4">
                    Analyzing the growing demand for digital services and how technology is reshaping traditional service industries.
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img
                            src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80"
                            srcset="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=32&q=80 32w, https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80 64w, https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=96&q=80 96w"
                            sizes="32px"
                            alt="Author"
                            class="w-8 h-8 rounded-full mr-2"
                            loading="lazy"
                            decoding="async"
                        >
                        <div>
                            <p class="text-sm font-medium text-gray-900">Fatima Alami</p>
                            <p class="text-xs text-gray-500">Jan 8, 2024</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">6 min read</span>
                </div>
            </div>
        </article>

        <!-- Blog Post 4 -->
        <article class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-200">
            <img
                src="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                srcset="https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=320&q=75 320w, https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80 400w, https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=640&q=80 640w"
                sizes="(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw"
                alt="Blog post"
                class="w-full h-48 object-cover"
                loading="lazy"
                decoding="async"
            >
            <div class="p-6">
                <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded text-xs font-medium mb-3 inline-block">Platform Updates</span>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    <a href="#" class="hover:text-blue-600 transition duration-200">New Features: Enhanced Messaging System</a>
                </h3>
                <p class="text-gray-600 mb-4">
                    Discover the latest improvements to our messaging system, designed to make communication between clients and taskers even smoother.
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80"
                            srcset="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=32&q=80 32w, https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80 64w, https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=96&q=80 96w"
                            sizes="32px"
                            alt="Author"
                            class="w-8 h-8 rounded-full mr-2"
                            loading="lazy"
                            decoding="async"
                        >
                        <div>
                            <p class="text-sm font-medium text-gray-900">Product Team</p>
                            <p class="text-xs text-gray-500">Jan 5, 2024</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">4 min read</span>
                </div>
            </div>
        </article>

        <!-- Blog Post 5 -->
        <article class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-200">
            <img
                src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                srcset="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=320&q=75 320w, https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80 400w, https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=640&q=80 640w"
                sizes="(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw"
                alt="Blog post"
                class="w-full h-48 object-cover"
                loading="lazy"
                decoding="async"
            >
            <div class="p-6">
                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium mb-3 inline-block">Tips & Guides</span>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    <a href="#" class="hover:text-blue-600 transition duration-200">Pricing Your Services: A Complete Guide</a>
                </h3>
                <p class="text-gray-600 mb-4">
                    Learn how to price your services competitively while ensuring fair compensation for your time and expertise.
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img
                            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80"
                            srcset="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=32&q=80 32w, https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80 64w, https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=96&q=80 96w"
                            sizes="32px"
                            alt="Author"
                            class="w-8 h-8 rounded-full mr-2"
                            loading="lazy"
                            decoding="async"
                        >
                        <div>
                            <p class="text-sm font-medium text-gray-900">David Rodriguez</p>
                            <p class="text-xs text-gray-500">Jan 3, 2024</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">8 min read</span>
                </div>
            </div>
        </article>

        <!-- Blog Post 6 -->
        <article class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-200">
            <img
                src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                srcset="https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&w=320&q=75 320w, https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80 400w, https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&w=640&q=80 640w"
                sizes="(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw"
                alt="Blog post"
                class="w-full h-48 object-cover"
                loading="lazy"
                decoding="async"
            >
            <div class="p-6">
                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium mb-3 inline-block">Success Stories</span>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    <a href="#" class="hover:text-blue-600 transition duration-200">From Student to Entrepreneur: Layla's Journey</a>
                </h3>
                <p class="text-gray-600 mb-4">
                    How a university student turned her graphic design skills into a successful freelance business through M3alam.
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img
                            src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80"
                            srcset="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=32&q=80 32w, https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=64&q=80 64w, https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=96&q=80 96w"
                            sizes="32px"
                            alt="Author"
                            class="w-8 h-8 rounded-full mr-2"
                            loading="lazy"
                            decoding="async"
                        >
                        <div>
                            <p class="text-sm font-medium text-gray-900">Emma Wilson</p>
                            <p class="text-xs text-gray-500">Dec 30, 2023</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">6 min read</span>
                </div>
            </div>
        </article>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mb-16">
        <nav class="flex space-x-2">
            <button class="px-3 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded transition duration-200" disabled>
                Previous
            </button>
            <button class="px-3 py-2 bg-blue-600 text-white rounded">1</button>
            <button class="px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded transition duration-200">2</button>
            <button class="px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded transition duration-200">3</button>
            <button class="px-3 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded transition duration-200">
                Next
            </button>
        </nav>
    </div>

    <!-- Newsletter Signup -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-8 text-center text-white">
        <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
        <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
            Subscribe to our newsletter to get the latest insights, tips, and updates from the M3alam community delivered to your inbox.
        </p>
        <div class="max-w-md mx-auto flex">
            <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-l-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-white">
            <button class="bg-white text-blue-600 px-6 py-3 rounded-r-lg font-medium hover:bg-blue-50 transition duration-200">
                Subscribe
            </button>
        </div>
    </div>
</div>
@endsection
