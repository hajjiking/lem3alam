@extends('layouts.app')

@section('title', __('Reviews for :name', ['name' => $tasker->name]))

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        
        <!-- Header -->
        <div class="card-glass mb-8">
            <div class="page-hero-gradient px-8 py-8 position-relative">
                 <div class="position-absolute top-0 start-0 w-100 h-100 pattern-overlay-white-10"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-6">
                        <div class="p-1 rounded-full bg-white/20 backdrop-blur-sm">
                            <img src="{{ $tasker->profile_image ? asset('storage/' . $tasker->profile_image) : asset('images/default-avatar.png') }}" 
                                 alt="{{ $tasker->name }}" 
                                 class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-md"
                                 style="width: min(200px, 35vw); height: min(200px, 35vw); object-fit: cover; border-radius: 50%;"
                                 loading="eager"
                                 decoding="async">
                        </div>
                        <div class="text-center md:text-left text-white">
                            <h1 class="text-3xl font-bold mb-1">{{ __('Reviews for :name', ['name' => $tasker->name]) }}</h1>
                            <div class="flex items-center justify-center md:justify-start gap-2 text-blue-100">
                                <span class="font-medium text-lg">{{ $stats['total_reviews'] }}</span> {{ __('reviews') }}
                                <span class="w-1 h-1 rounded-full bg-blue-300"></span>
                                <span class="font-medium text-lg">{{ number_format($stats['average_rating'], 1) }}</span> <span style="color: #eab308; font-size: 14px;">★</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('tasker.profile.show', $tasker) }}" 
                       class="px-6 py-2.5 bg-white/10 hover:bg-white/20 text-white border border-white/30 rounded-xl font-medium transition-all duration-200 backdrop-blur-md flex items-center">
                        {{ __('View Profile') }}
                        <svg class="w-4 h-4 ml-2 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar with Stats & Filters -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Rating Overview -->
                <div class="card-glass p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="mr-2" style="width: 16px; height: 16px; color: #eab308;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        {{ __('ui.rating_overview') }}
                    </h3>
                    
                    <!-- Average Rating -->
                    <div class="text-center mb-8 pb-8 border-b border-gray-100">
                        <div class="text-5xl font-extrabold text-gray-900 mb-2">{{ number_format($stats['average_rating'], 1) }}</div>
                        <div class="flex justify-center items-center space-x-1 mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="text-sm {{ $i <= round($stats['average_rating']) ? 'text-yellow-500' : 'text-gray-200' }}">★</span>
                            @endfor
                        </div>
                        <p class="text-sm text-gray-500 font-medium">{{ __('Based on :count reviews', ['count' => $stats['total_reviews']]) }}</p>
                    </div>

                    <!-- Rating Breakdown -->
                    <div class="space-y-3">
                        @for($i = 5; $i >= 1; $i--)
                            @php
                                $count = $stats['rating_breakdown'][$i] ?? 0;
                                $percentage = $stats['total_reviews'] > 0 ? ($count / $stats['total_reviews']) * 100 : 0;
                            @endphp
                            <div class="flex items-center text-sm">
                                <span class="text-gray-600 font-medium w-8 flex items-center">{{ $i }} <span class="text-xs ml-0.5 text-yellow-500">★</span></span>
                                <div class="flex-1 mx-3 h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full {{ $i >= 4 ? 'bg-green-500' : ($i == 3 ? 'bg-blue-500' : 'bg-orange-500') }}" style="width: {{ $percentage }}%"></div>
                                </div>
                                <span class="text-gray-400 w-8 text-right text-xs">{{ $count }}</span>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Filters -->
                <div class="card-glass p-6 sticky top-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" style="width: 20px; height: 20px; min-width: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        {{ __('Filter Reviews') }}
                    </h3>
                    
                    <form id="filter-form" method="GET">
                        <!-- Rating Filter -->
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('ui.by_rating') }}</label>
                            <select name="rating" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                                <option value="all" {{ request('rating') == 'all' ? 'selected' : '' }}>{{ __('ui.all_ratings') }}</option>
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} {{ __('ui.stars') }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Sort Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Sort By') }}</label>
                            <select name="sort" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>{{ __('Most Recent') }}</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('Oldest First') }}</option>
                                <option value="highest_rating" {{ request('sort') == 'highest_rating' ? 'selected' : '' }}>{{ __('Highest Rating') }}</option>
                                <option value="lowest_rating" {{ request('sort') == 'lowest_rating' ? 'selected' : '' }}>{{ __('Lowest Rating') }}</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all duration-200 shadow-md shadow-blue-200">
                            {{ __('Apply Filters') }}
                        </button>
                        
                        @if(request()->has('rating') || request()->has('sort'))
                            <a href="{{ route('reviews.index', $tasker) }}" class="block text-center mt-3 text-sm text-gray-500 hover:text-gray-700 underline">
                                {{ __('Clear Filters') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Reviews List -->
            <div class="lg:col-span-3">
                @if($reviews->count() > 0)
                    <div class="space-y-6">
                        @foreach($reviews as $review)
                            <div class="card-glass p-8 {{ auth()->check() && auth()->id() === $review->client_id ? 'ring-2 ring-blue-500 ring-offset-2' : '' }}">
                                <!-- Review Header -->
                                <div class="flex items-start justify-between mb-6">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $review->client->profile_image ? asset('storage/' . $review->client->profile_image) : asset('images/default-avatar.png') }}" 
                                             alt="{{ $review->client->name }}" 
                                             class="w-12 h-12 rounded-full object-cover border border-gray-100"
                                             loading="lazy"
                                             decoding="async">
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-lg flex items-center">
                                                {{ $review->client->name }}
                                                @if(auth()->check() && auth()->id() === $review->client_id)
                                                    <span class="ml-3 inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">{{ __('Your Review') }}</span>
                                                @endif
                                            </h4>
                                            <p class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Rating Badge -->
                                    <div class="flex flex-col items-end">
                                        <div class="flex items-center bg-gray-50 px-3 py-1 rounded-lg border border-gray-100">
                                            <span class="font-bold text-gray-900 mr-1">{{ number_format($review->rating, 1) }}</span>
                                            <span style="color: #eab308; font-size: 12px;">★</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Task Info -->
                                @if($review->task)
                                    <div class="mb-5">
                                        <a href="{{ localized_route('tasks.show', $review->task->id) }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors">
                                            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                            {{ __('Task:') }} {{ $review->task->title }}
                                        </a>
                                    </div>
                                @endif

                                <!-- Review Content -->
                                <div class="prose max-w-none mb-4">
                                    <p class="text-gray-700 leading-relaxed text-lg">{{ $review->getComment() }}</p>
                                </div>

                                <!-- Footer / Badges -->
                                @if($review->is_featured)
                                    <div class="mt-4 pt-4 border-t border-gray-50 flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                            ⭐ {{ __('Featured Review') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-10">
                        {{ $reviews->appends(request()->query())->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="card-glass p-16 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-50 mb-6">
                            <svg class="h-10 w-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('ui.no_reviews_yet') }}</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">{{ __('ui.no_reviews_criteria') }}</p>
                        
                        @if(request()->has('rating') || request()->has('sort'))
                            <a href="{{ route('reviews.index', $tasker) }}" 
                               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all duration-200 font-medium">
                                {{ __('ui.clear_filters') }}
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const selects = filterForm.querySelectorAll('select');
    
    selects.forEach(select => {
        select.addEventListener('change', function() {
            filterForm.submit();
        });
    });
});
</script>
@endpush
@endsection
