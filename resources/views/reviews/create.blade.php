@extends('layouts.app')

@section('title', __('Leave a Review'))

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
                            <img src="{{ (isset($tasker) && $tasker->profile_image) ? asset('storage/' . $tasker->profile_image) : asset('images/default-avatar.png') }}" 
                                 alt="{{ isset($tasker) ? $tasker->name : __('Unknown') }}" 
                                 class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg"
                                 style="width: min(200px, 35vw); height: min(200px, 35vw); object-fit: cover; border-radius: 50%;"
                                 loading="eager"
                                 decoding="async">
                        </div>
                        <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">{{ __('Rate Your Experience') }}</h1>
                        <p class="text-blue-100 text-lg font-medium">{{ __('with') }} {{ isset($tasker) ? $tasker->name : __('Unknown Tasker') }}</p>
                        @if($task)
                            <div class="mt-3 inline-flex items-center px-3 py-1 rounded-full bg-white/10 border border-white/20 text-white text-sm backdrop-blur-md">
                                <svg class="w-4 h-4 mr-2" style="width: 16px; height: 16px; min-width: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                {{ $task->title }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Form Section -->
                <div class="px-8 py-10">
                    @php
                        $canSubmitVal = isset($canSubmit) ? $canSubmit : true;
                        $actionUrl = (isset($tasker) && $canSubmitVal) ? route('reviews.store', ['locale' => app()->getLocale(), 'tasker' => $tasker->id]) : '#';
                    @endphp

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

                    @if(isset($errorMessage) && $errorMessage)
                        <div class="mb-8 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" style="width: 20px; height: 20px; min-width: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                <span>{{ $errorMessage }}</span>
                            </div>
                            @isset($existingReview)
                                <div class="mt-3 pl-8">
                                    <a href="{{ route('reviews.show', $existingReview) }}" class="text-blue-600 hover:text-blue-800 font-medium underline">{{ __('View your existing review') }}</a>
                                </div>
                            @endisset
                        </div>
                    @endif

                    <form id="review-form" action="{{ $actionUrl }}" method="POST">
                        @csrf
                        
                        @if($task)
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                        @endif

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
                            @include('components.rating-control', ['name' => 'quality_rating', 'title' => __('Quality of work')])
                            @include('components.rating-control', ['name' => 'communication_rating', 'title' => __('Communication')])
                            @include('components.rating-control', ['name' => 'timeliness_rating', 'title' => __('Timeliness')])
                            @include('components.rating-control', ['name' => 'professionalism_rating', 'title' => __('Professionalism')])
                        </div>

                        <hr class="my-10 border-gray-100">

                        <!-- Comments Section -->
                        <div class="grid md:grid-cols-2 gap-8">
                            <!-- Comment in French -->
                            <div>
                                <label for="comment" class="block text-base font-semibold text-gray-800 mb-2">
                                    {{ __('ui.your_review') }} ({{ __('French') }}) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <textarea name="comment" 
                                              id="comment" 
                                              rows="5" 
                                              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent transition-all duration-200 resize-none"
                                              placeholder="{{ __('Share your experience with this tasker...') }}"
                                              required>{{ old('comment') }}</textarea>
                                    <div class="text-right text-xs text-gray-400 mt-1 pointer-events-none">Min 20 chars</div>
                                </div>
                                @error('comment')
                                    <p class="text-red-500 text-sm mt-2 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Comment in Arabic (Optional) -->
                            <div>
                                <label for="comment_ar" class="block text-base font-semibold text-gray-800 mb-2">
                                    {{ __('ui.your_review') }} ({{ __('Arabic') }}) <span class="text-gray-400 font-normal">({{ __('Optional') }})</span>
                                </label>
                                <textarea name="comment_ar" 
                                          id="comment_ar" 
                                          rows="5" 
                                          class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent transition-all duration-200 resize-none"
                                          placeholder="{{ __('Share your experience in Arabic...') }}"
                                          dir="rtl">{{ old('comment_ar') }}</textarea>
                                @error('comment_ar')
                                    <p class="text-red-500 text-sm mt-2 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Guidelines -->
                        <div class="mt-8 bg-blue-50 border border-blue-100 rounded-xl p-6">
                            <h3 class="text-sm font-bold text-blue-800 mb-3 uppercase tracking-wide flex items-center">
                            <svg class="w-4 h-4 mr-2" style="width: 16px; height: 16px; min-width: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ __('ui.review_guidelines') }}
                        </h3>
                            <ul class="text-sm text-blue-700 space-y-2 pl-1">
                                <li class="flex items-start"><span class="mr-2">•</span> {{ __('ui.be_honest') }}</li>
                                <li class="flex items-start"><span class="mr-2">•</span> {{ __('ui.focus_quality') }}</li>
                                <li class="flex items-start"><span class="mr-2">•</span> {{ __('ui.avoid_personal') }}</li>
                                <li class="flex items-start"><span class="mr-2">•</span> {{ __('ui.review_moderated') }}</li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-4 mt-10 pt-6 border-t border-gray-100">
                            <a href="{{ isset($tasker) ? route('tasker.profile.show', $tasker) : (isset($task) ? localized_route('tasks.show', $task->id) : localized_route('tasks.index')) }}" 
                               class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors duration-200">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" 
                                    {{ !$canSubmitVal || !isset($tasker) ? 'disabled aria-disabled=true' : '' }}
                                    class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 hover:shadow-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-100 transform active:scale-95 transition-all duration-200 {{ (!$canSubmitVal || !isset($tasker)) ? 'opacity-50 cursor-not-allowed' : '' }}">
                                {{ __('ui.submit_review') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@php
    $reviewLabels = [
        1 => __('ui.bad'),
        2 => __('ui.satisfactory'),
        3 => __('ui.good'),
        4 => __('ui.very_good'),
        5 => __('ui.excellent'),
    ];
@endphp
<script>
document.addEventListener('DOMContentLoaded', function() {
    const labels = @json($reviewLabels);
    const ratingUpdatedText = @json(__('ui.rating_updated'));
    const ratingUpdatedAltText = @json(__('Rating updated'));
    const selectAllCriteriaText = @json(__('Please select a rating for all criteria'));
    const offlineAlertText = @json(__('You are offline. Your input has been saved locally. Please retry when online.'));
    const offlineFeedbackText = @json(__('Submission failed (offline). Your input is saved locally.'));
    const submittingText = @json(__('Submitting your review...'));
    const storageKey = 'm3_review_criteria';
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

    function saveState() {
        const state = {
            q: document.querySelector('input[name="quality_rating"]').value,
            c: document.querySelector('input[name="communication_rating"]').value,
            t: document.querySelector('input[name="timeliness_rating"]').value,
            p: document.querySelector('input[name="professionalism_rating"]').value,
            comment: document.querySelector('#comment')?.value || '',
            comment_ar: document.querySelector('#comment_ar')?.value || ''
        };
        try { localStorage.setItem(storageKey, JSON.stringify(state)); } catch(e) {}
    }

    function restoreState() {
        try {
            const raw = localStorage.getItem(storageKey);
            if (!raw) return;
            const s = JSON.parse(raw);
            const map = {
                quality_rating: s.q, communication_rating: s.c,
                timeliness_rating: s.t, professionalism_rating: s.p
            };
            Object.entries(map).forEach(([k,v])=>{
                const hidden = document.querySelector(`input[name="${k}"]`);
                if (hidden && v) {
                    const ctrl = hidden.closest('.rating-control');
                    if (ctrl) updateRatingUI(ctrl, parseFloat(v));
                }
            });
            if (s.comment) document.querySelector('#comment').value = s.comment;
            if (s.comment_ar) document.querySelector('#comment_ar').value = s.comment_ar;
        } catch(e) {}
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

        saveState(); 
        computeOverall();
    }

    document.querySelectorAll('.rating-control').forEach(ctrl=>{
        const disabled = ctrl.getAttribute('data-disabled') === '1';
        
        if (!disabled) {
            // Click on emoji
            ctrl.querySelectorAll('.rating-choice').forEach(c=>{
                c.addEventListener('click', ()=> {
                    updateRatingUI(ctrl, parseInt(c.dataset.rating));
                    showFeedback('success', ratingUpdatedText);
                });
            });
            
            // Click on stars
            ctrl.querySelectorAll('.rating-star').forEach(star=>{
                star.setAttribute('tabindex', '0');
                star.addEventListener('click', (e)=>{
                    const base = parseInt(star.dataset.rating);
                    updateRatingUI(ctrl, base);
                    showFeedback('success', ratingUpdatedAltText);
                });
                star.addEventListener('keydown', (e)=>{
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        const base = parseInt(star.dataset.rating);
                        updateRatingUI(ctrl, base);
                    }
                });
            });
        }
        
        // Initialize
        const input = ctrl.querySelector(`input[type="hidden"]`);
        const initial = parseFloat(input.value || 0);
        if (initial) updateRatingUI(ctrl, initial);
    });

    restoreState();
    computeOverall();

    const form = document.getElementById('review-form');
    if (form) {
        form.addEventListener('submit', function(e){
            const required = ['quality_rating','communication_rating','timeliness_rating','professionalism_rating'];
            const invalid = required.filter(n=>{
                const v = parseFloat(document.querySelector(`input[name="${n}"]`).value || 0);
                return !(v >= 1 && v <= 5);
            });
            if (invalid.length) {
                e.preventDefault();
                showFeedback('error', selectAllCriteriaText);
                // Scroll to first invalid
                const first = document.querySelector(`input[name="${invalid[0]}"]`).closest('.rating-control');
                first.scrollIntoView({behavior: 'smooth', block: 'center'});
                return;
            }
            if (!navigator.onLine) {
                e.preventDefault();
                alert(offlineAlertText);
                saveState();
                showFeedback('error', offlineFeedbackText);
                return;
            }
            showFeedback('success', submittingText);
        });
    }
});
</script>
@endpush
@endsection
