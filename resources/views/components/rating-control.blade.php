@php
    $disabled = isset($canSubmit) && !$canSubmit;
    $initial = old($name, $value ?? '');
@endphp
<div class="mb-8 rating-control" data-name="{{ $name }}" data-disabled="{{ $disabled ? '1' : '0' }}">
    <div class="flex items-center justify-between mb-3">
        <label class="text-base font-semibold text-gray-800">{{ $title }} <span class="text-red-500">*</span></label>
        <span class="rating-current text-sm font-medium text-blue-600 min-h-[20px]"></span>
    </div>
    <input type="hidden" name="{{ $name }}" value="{{ $initial }}">
    
    <!-- Emoji Selection -->
    <div class="grid grid-cols-5 gap-2 mb-4 rating-choices">
        @foreach([
            1 => ['emoji' => '😠', 'label' => __('Bad')],
            2 => ['emoji' => '🙂', 'label' => __('Satisfactory')],
            3 => ['emoji' => '😊', 'label' => __('Good')],
            4 => ['emoji' => '😃', 'label' => __('Very Good')],
            5 => ['emoji' => '🤩', 'label' => __('Excellent')]
        ] as $val => $data)
        <button type="button" 
                class="rating-choice group flex flex-col items-center justify-center p-3 rounded-xl border border-gray-200 bg-gray-50 hover:bg-white hover:border-blue-200 hover:shadow-md transition-all duration-200 {{ $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}"
                data-rating="{{ $val }}" 
                {{ $disabled ? 'disabled' : '' }}>
            <span class="rating-face text-2xl mb-1 group-hover:scale-110 transition-transform duration-200">{{ $data['emoji'] }}</span>
            <span class="rating-text text-[10px] text-gray-500 font-medium uppercase tracking-wide group-hover:text-blue-600">{{ $data['label'] }}</span>
        </button>
        @endforeach
    </div>

    <!-- Star Slider (Visual Feedback) -->
    <div class="relative pt-1 px-1">
        <div class="flex justify-between items-center mb-1 px-1">
             <div class="rating-stars flex gap-1">
                @for($i=1;$i<=5;$i++)
                    <span class="rating-star cursor-pointer transition-colors duration-200" style="font-size: 20px; color: #d1d5db;" data-rating="{{ $i }}">★</span>
                @endfor
            </div>
        </div>
        <div class="rating-slider relative w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
            <div class="rating-fill absolute top-0 left-0 h-full bg-blue-500 transition-all duration-300 w-0"></div>
        </div>
    </div>
</div>

<style>
.rating-choice.active { 
    background-color: #eff6ff; /* blue-50 */
    border-color: #3b82f6; /* blue-500 */
    box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.1);
}
.rating-choice.active .rating-text {
    color: #2563eb; /* blue-600 */
    font-weight: 700;
}
.rating-choice.active .rating-face {
    transform: scale(1.2);
}
.rating-star:hover {
    color: #eab308 !important;
}
</style>
