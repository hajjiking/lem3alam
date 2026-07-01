@extends('layouts.app')

@section('title', __('Edit Review'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Main Card -->
        <div class="card-glass overflow-hidden">
            <!-- Header with Gradient -->
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
                    <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">{{ __('Edit Review') }}</h1>
                    <p class="text-blue-100 text-lg font-medium">{{ __('for') }} {{ $review->tasker->name }}</p>
                    @if($review->task)
                        <div class="mt-3 inline-flex items-center px-3 py-1 rounded-full bg-white/10 border border-white/20 text-white text-sm backdrop-blur-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            {{ $review->task->title }}
                        </div>
                    @endif
                    
                    <div class="mt-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100/20 text-yellow-100 border border-yellow-200/30 backdrop-blur-sm">
                            {{ $review->status === 'approved' ? __('Published') : __('Pending Approval') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Review Form -->
            <div class="px-8 py-10">
                <form action="{{ route('reviews.update', $review) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Overall Rating Display -->
                    <div class="flex flex-col items-center justify-center mb-10 p-6 bg-gray-50 rounded-xl border border-gray-100">
                        <span class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">{{ __('Overall Rating') }}</span>
                        <div class="flex items-end gap-3">
                            <div id="overall-stars" class="flex gap-1">
                                @for($i=1;$i<=5;$i++)
                                    <span style="font-size: 24px; color: #e5e7eb;" class="transition-colors duration-300">★</span>
                                @endfor
                            </div>
                            <span id="overall-text" class="text-2xl font-bold text-gray-800 min-w-[3ch] text-center mb-1">0.0</span>
                        </div>
                    </div>

                    <div id="rating-feedback" class="hidden mb-6 px-4 py-3 rounded-lg border text-sm font-medium transition-all duration-300"></div>

                    <div class="space-y-8">
                        @include('components.rating-control', [
                            'name' => 'quality_rating', 
                            'title' => __('Quality of work'),
                            'value' => $review->metadata['criteria']['quality'] ?? null
                        ])
                        @include('components.rating-control', [
                            'name' => 'communication_rating', 
                            'title' => __('Communication'),
                            'value' => $review->metadata['criteria']['communication'] ?? null
                        ])
                        @include('components.rating-control', [
                            'name' => 'timeliness_rating', 
                            'title' => __('Timeliness'),
                            'value' => $review->metadata['criteria']['timeliness'] ?? null
                        ])
                        @include('components.rating-control', [
                            'name' => 'professionalism_rating', 
                            'title' => __('Professionalism'),
                            'value' => $review->metadata['criteria']['professionalism'] ?? null
                        ])
                    </div>

                    <hr class="my-10 border-gray-100">

                    <div class="grid md:grid-cols-2 gap-8 mb-8">
                        <!-- Comment in French -->
                        <div>
                            <label for="comment" class="block text-base font-semibold text-gray-800 mb-2">
                                {{ __('Your Review') }} ({{ __('French') }}) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <textarea name="comment" 
                                          id="comment" 
                                          rows="5" 
                                          class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent transition-all duration-200 resize-none"
                                          placeholder="{{ __('Share your experience with this tasker...') }}"
                                          required>{{ old('comment', $review->comment_translations['fr'] ?? $review->comment) }}</textarea>
                                <div class="text-right text-xs text-gray-400 mt-1 pointer-events-none">{{ __('Min 20 chars') }}</div>
                            </div>
                            @error('comment')
                                <p class="text-red-500 text-sm mt-2 flex items-center"><svg class="w-4 h-4 mr-1" style="width: 16px; height: 16px; min-width: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Comment in Arabic (Optional) -->
                        <div>
                            <label for="comment_ar" class="block text-base font-semibold text-gray-800 mb-2">
                                {{ __('Your Review') }} ({{ __('Arabic') }}) <span class="text-gray-400 font-normal">({{ __('Optional') }})</span>
                            </label>
                            <textarea name="comment_ar" 
                                      id="comment_ar" 
                                      rows="5" 
                                      class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent transition-all duration-200 resize-none"
                                      placeholder="{{ __('Share your experience in Arabic...') }}"
                                      dir="rtl">{{ old('comment_ar', $review->comment_translations['ar'] ?? '') }}</textarea>
                            @error('comment_ar')
                                <p class="text-red-500 text-sm mt-2 flex items-center"><svg class="w-4 h-4 mr-1" style="width: 16px; height: 16px; min-width: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Guidelines -->
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 mb-8">
                        <h3 class="text-sm font-bold text-blue-800 mb-3 uppercase tracking-wide flex items-center">
                            <svg class="w-4 h-4 mr-2" style="width: 16px; height: 16px; min-width: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ __('Review Guidelines') }}
                        </h3>
                        <ul class="text-sm text-blue-700 space-y-2 pl-1">
                            <li class="flex items-start"><span class="mr-2">•</span> {{ __('Be honest and constructive in your feedback') }}</li>
                            <li class="flex items-start"><span class="mr-2">•</span> {{ __('Focus on the quality of work and professionalism') }}</li>
                            <li class="flex items-start"><span class="mr-2">•</span> {{ __('Avoid personal attacks or inappropriate language') }}</li>
                            <li class="flex items-start"><span class="mr-2">•</span> {{ __('Your review will be moderated before being published') }}</li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center pt-6 border-t border-gray-100">
                        <div class="flex space-x-3">
                            <a href="{{ url()->previous() }}" 
                               class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors duration-200">
                                {{ __('Cancel') }}
                            </a>
                            
                            <!-- Delete Button -->
                            @if(Auth::check() && Auth::id() === $review->client_id && now()->diffInHours($review->created_at) <= 24)
                            <button type="button" 
                                    onclick="document.getElementById('delete-review-form').submit()"
                                    class="px-6 py-3 border border-red-200 text-red-600 rounded-xl hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors duration-200">
                                {{ __('Delete') }}
                            </button>
                            @endif
                        </div>
                        
                        <button type="submit" 
                                class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 hover:shadow-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-100 transform active:scale-95 transition-all duration-200">
                            {{ __('Update Review') }}
                        </button>
                    </div>
                </form>
                
                @if(Auth::check() && Auth::id() === $review->client_id && now()->diffInHours($review->created_at) <= 24)
                    <form id="delete-review-form" action="{{ route('reviews.destroy', $review) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
            </div>
        </div>

        <!-- Review History -->
        <div class="card-glass p-6 mt-6">
            <h3 class="text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">{{ __('Review Status') }}</h3>
            <div class="text-sm text-gray-600 space-y-2">
                <p class="flex justify-between">
                    <span class="font-medium text-gray-500">{{ __('Created:') }}</span> 
                    <span>{{ $review->created_at->format('M d, Y \a\t H:i') }}</span>
                </p>
                @if($review->updated_at != $review->created_at)
                    <p class="flex justify-between">
                        <span class="font-medium text-gray-500">{{ __('Last Updated:') }}</span> 
                        <span>{{ $review->updated_at->format('M d, Y \a\t H:i') }}</span>
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
@php
    $reviewLabels = [
        1 => __('Bad'),
        2 => __('Satisfactory'),
        3 => __('Good'),
        4 => __('Very Good'),
        5 => __('Excellent'),
    ];
@endphp
<script>
document.addEventListener('DOMContentLoaded', function() {
    const labels = @json($reviewLabels);
    const feedback = document.getElementById('rating-feedback');
    
    function showFeedback(type, text) {
        if (!feedback) return;
        feedback.classList.remove('hidden','bg-green-50','border-green-200','text-green-700','bg-red-50','border-red-200','text-red-700');
        if (type === 'success') {
            feedback.classList.add('bg-green-50','border-green-200','text-green-700');
        } else {
            feedback.classList.add('bg-red-50','border-red-200','text-red-700');
        }
        feedback.textContent = text;
        feedback.classList.remove('hidden');
    }

    function computeOverall() {
        const vals = ['quality_rating','communication_rating','timeliness_rating','professionalism_rating']
          .map(n=>parseInt(document.querySelector(`input[name="${n}"]`).value || 0))
          .filter(v=>v>=1 && v<=5);
        
        const overall = vals.length === 4 ? (vals.reduce((a,b)=>a+b,0)/4) : 0;
        const roundedOverall = Math.round(overall); // For stars
        
        const stars = document.querySelectorAll('#overall-stars span');
        stars.forEach((s,i)=>{ 
            if (i < roundedOverall) { 
                s.style.color = '#eab308';
            } else { 
                s.style.color = '#e5e7eb';
            } 
        });
        
        const overallText = document.getElementById('overall-text');
        if (overall > 0) {
            overallText.textContent = overall.toFixed(1);
            overallText.className = 'text-2xl font-bold min-w-[3ch] text-center mb-1 ' + (overall >= 4 ? 'text-green-600' : (overall >= 3 ? 'text-blue-600' : 'text-orange-500'));
        } else {
             overallText.textContent = '0.0';
             overallText.className = 'text-2xl font-bold text-gray-300 min-w-[3ch] text-center mb-1';
        }
    }

    function updateRatingUI(ctrl, val) {
        const input = ctrl.querySelector(`input[type="hidden"]`);
        const choices = ctrl.querySelectorAll('.rating-choice');
        const stars = ctrl.querySelectorAll('.rating-star');
        const current = ctrl.querySelector('.rating-current');
        const fill = ctrl.querySelector('.rating-fill');
        
        input.value = val;
        
        // Update emoji choices
        choices.forEach(c=>c.classList.toggle('active', parseInt(c.dataset.rating) === Math.round(val)));
        
        // Update stars
        stars.forEach((s,i)=>{ 
            if (i < Math.floor(val)) { 
                s.style.color = '#eab308';
            } else { 
                s.style.color = '#d1d5db';
            } 
        });
        
        // Update text
        current.textContent = labels[Math.round(val)] ? labels[Math.round(val)] : '';
        
        // Update slider fill
        if (fill) {
            const percentage = (val / 5) * 100;
            fill.style.width = `${percentage}%`;
            // Color based on value
            fill.className = `rating-fill absolute top-0 left-0 h-full transition-all duration-300 w-0 ${val >= 4 ? 'bg-green-500' : (val >= 3 ? 'bg-blue-500' : 'bg-orange-500')}`;
        }

        computeOverall();
    }

    document.querySelectorAll('.rating-control').forEach(ctrl=>{
        const disabled = ctrl.getAttribute('data-disabled') === '1';
        
        if (!disabled) {
            // Click on emoji
            ctrl.querySelectorAll('.rating-choice').forEach(c=>{
                c.addEventListener('click', ()=> {
                    updateRatingUI(ctrl, parseInt(c.dataset.rating));
                });
            });

            // Click on star
            ctrl.querySelectorAll('.rating-star').forEach(s=>{
                s.addEventListener('click', ()=> {
                    updateRatingUI(ctrl, parseInt(s.dataset.rating));
                });
            });
        }

        // Initialize from value if present
        const input = ctrl.querySelector(`input[type="hidden"]`);
        if (input && input.value) {
            updateRatingUI(ctrl, parseFloat(input.value));
        }
    });

    // Compute overall on load
    computeOverall();
});
</script>
@endpush
@endsection
