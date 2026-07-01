@extends('layouts.app')

@section('title', __('Review Details'))

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            
            <!-- Main Card -->
            <div class="card-glass overflow-hidden">
                
                <!-- Decorative Header -->
                <div class="page-hero-gradient px-8 py-10 text-center position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 w-100 h-100 pattern-overlay-white-10"></div>
                    
                    
                    <div class="relative z-10">
                        <div class="inline-block p-1 rounded-full bg-white/20 backdrop-blur-sm mb-4">
                            <img src="{{ $review->tasker->profile_image ? asset('storage/' . $review->tasker->profile_image) : asset('images/default-avatar.png') }}" 
                                 alt="{{ $review->tasker->name }}" 
                                 class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg"
                                 style="width: min(200px, 35vw); height: min(200px, 35vw); object-fit: cover; border-radius: 50%;"
                                 loading="eager"
                                 decoding="async">
                        </div>
                        <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">{{ __('Review for :name', ['name' => $review->tasker->name]) }}</h1>
                        <p class="text-blue-100 text-lg font-medium">{{ $review->created_at->diffForHumans() }}</p>
                        
                        @if($review->task)
                            <div class="mt-3 inline-flex items-center px-3 py-1 rounded-full bg-white/10 border border-white/20 text-white text-sm backdrop-blur-md">
                                <svg class="w-4 h-4 mr-2" style="width: 16px; height: 16px; min-width: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                {{ $review->task->title }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Content Section -->
                <div class="px-8 py-10">
                    
                    @if(session('success'))
                        <div class="mb-8 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center shadow-sm">
                            <svg class="w-5 h-5 mr-3" style="width: 20px; height: 20px; min-width: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-8 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center shadow-sm">
                            <svg class="w-5 h-5 mr-3" style="width: 20px; height: 20px; min-width: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Overall Rating -->
                    <div class="flex flex-col items-center justify-center mb-10 p-6 bg-gray-50 rounded-xl border border-gray-100">
                        <span class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">{{ __('Overall Rating') }}</span>
                        <div class="flex items-end gap-3">
                            <div class="flex gap-1">
                                @for($i=1; $i<=5; $i++)
                                    <span style="font-size: 24px; color: {{ $i <= $review->rating ? '#eab308' : '#e5e7eb' }};">★</span>
                                @endfor
                            </div>
                            <span class="text-2xl font-bold text-gray-800 min-w-[3ch] text-center mb-1">{{ number_format($review->rating, 1) }}</span>
                        </div>
                    </div>

                    <!-- Detailed Ratings -->
                    @if(isset($review->metadata['criteria']))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        @foreach($review->metadata['criteria'] as $key => $value)
                            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-700 font-medium capitalize">{{ str_replace('_', ' ', $key) }}</span>
                                    <span class="font-bold flex items-center" style="color: #eab308;">
                                        {{ number_format($value, 1) }} <span class="ml-1" style="color: #eab308; font-size: 14px;">★</span>
                                    </span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="h-2 rounded-full" style="width: {{ ($value / 5) * 100 }}%; background-color: #eab308;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif

                    <hr class="my-10 border-gray-100">

                    <!-- Comment -->
                    <div class="mb-10">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">{{ __('Review Comment') }}</h3>
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 text-gray-700 italic leading-relaxed">
                            "{{ $review->getComment() }}"
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center mt-8">
                        <a href="{{ url()->previous() }}" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-medium transition-all duration-200">
                            {{ __('Back') }}
                        </a>

                        @if(Auth::check() && Auth::id() === $review->client_id && now()->diffInHours($review->created_at) <= 24)
                            <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this review?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-6 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 rounded-xl font-medium transition-all duration-200 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    {{ __('Delete Review') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
