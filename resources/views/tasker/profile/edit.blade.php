@extends('layouts.app')

@section('title', __('Edit Profile'))

@section('content')
<div class="space-y-6">
    <div class="ui-card">
        <div class="ui-card-body">
            <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Edit Profile') }}</h1>
            <p class="ui-muted mt-1">{{ __('Update your profile information to attract more clients') }}</p>
        </div>
    </div>

    @if($errors->any())
        <div class="ui-card border-rose-200/70 dark:border-rose-900/40">
            <div class="ui-card-body flex items-start gap-3">
                <div class="ui-badge border-rose-200 bg-rose-50 text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/25 dark:text-rose-200">ERR</div>
                <div class="min-w-0">
                    <div class="text-sm font-extrabold text-slate-900 dark:text-white">{{ __('Please fix the following errors') }}</div>
                    <ul class="mt-2 list-disc ps-5 text-sm text-slate-700 dark:text-slate-200">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ localized_route('tasker.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="ui-card overflow-hidden">
            <div class="border-b border-slate-200/70 px-6 py-5 dark:border-slate-800/70">
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-user text-slate-400" aria-hidden="true"></i>
                    <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Basic Information') }}</h2>
                </div>
            </div>

            <div class="ui-card-body">
                <div class="grid gap-5 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="ui-label" for="profile_image">{{ __('Profile Image') }}</label>
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                            <div class="h-24 w-24 overflow-hidden rounded-full border border-slate-200/70 bg-slate-100 shadow-sm dark:border-slate-800/70 dark:bg-slate-900/40">
                                @if($user->profile_image)
                                    <img src="{{ Storage::url($user->profile_image) }}" alt="{{ $user->name }}" class="h-full w-full object-cover" loading="lazy" decoding="async">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-slate-400">
                                        <i class="fa-regular fa-user text-3xl" aria-hidden="true"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <input type="file" name="profile_image" id="profile_image" accept="image/*" class="ui-input file:me-3 file:rounded-lg file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-800 dark:file:bg-white dark:file:text-slate-900 dark:hover:file:bg-slate-100">
                                <div class="ui-muted mt-2">{{ __('PNG, JPG, GIF up to 2MB') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="bio" class="ui-label">{{ __('Bio (French)') }}</label>
                        <textarea name="bio" id="bio" rows="4" class="ui-input" placeholder="{{ __('Tell clients about yourself, your experience, and what makes you unique...') }}">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label for="bio_ar" class="ui-label">{{ __('Bio (Arabic)') }}</label>
                        <textarea name="bio_ar" id="bio_ar" rows="4" class="ui-input" dir="rtl" placeholder="{{ __('نبذة عنك باللغة العربية...') }}">{{ old('bio_ar', $user->bio_translations['ar'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="hourly_rate" class="ui-label">{{ __('Hourly Rate (DH)') }}</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3 text-sm font-semibold text-slate-500 dark:text-slate-400">DH</div>
                            <input type="number" name="hourly_rate" id="hourly_rate" step="0.01" min="0" value="{{ old('hourly_rate', $user->hourly_rate) }}" class="ui-input ps-12" placeholder="0.00">
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="ui-label">{{ __('Phone') }}</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="ui-input" placeholder="+212 6XX XXX XXX">
                    </div>

                    <div>
                        <label for="city" class="ui-label">{{ __('City') }}</label>
                        <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}" class="ui-input" placeholder="{{ __('Casablanca, Rabat, etc.') }}">
                    </div>

                    <div>
                        <label for="address" class="ui-label">{{ __('Address') }}</label>
                        <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" class="ui-input" placeholder="{{ __('Your address') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="ui-card overflow-hidden">
            <div class="border-b border-slate-200/70 px-6 py-5 dark:border-slate-800/70">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-screwdriver-wrench text-slate-400" aria-hidden="true"></i>
                    <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Skills') }}</h2>
                </div>
                <div class="ui-muted mt-1">{{ __('Select your skills and specify your experience level') }}</div>
            </div>

            <div class="ui-card-body">
                <div id="skills-container" class="space-y-5">
                    @foreach($allSkills as $categoryName => $categorySkills)
                        <div class="rounded-2xl border border-slate-200/70 bg-slate-50/70 p-5 dark:border-slate-800/60 dark:bg-slate-900/20">
                            <div class="flex items-center gap-2 text-sm font-extrabold tracking-tight text-slate-900 dark:text-white">
                                <i class="fa-solid fa-layer-group text-slate-400" aria-hidden="true"></i>
                                <span class="truncate">{{ $categoryName }}</span>
                            </div>

                            <div class="mt-4 grid gap-3 md:grid-cols-2 lg:grid-cols-3">
                                @foreach($categorySkills as $skill)
                                    <div class="skill-item rounded-2xl border border-slate-200/70 bg-white/70 p-4 shadow-sm backdrop-blur dark:border-slate-800/60 dark:bg-slate-950/45">
                                        <label class="flex cursor-pointer items-center gap-3">
                                            <input
                                                type="checkbox"
                                                name="skills[]"
                                                value="{{ $skill->id }}"
                                                {{ in_array($skill->id, $userSkills) ? 'checked' : '' }}
                                                class="skill-checkbox h-5 w-5 rounded border-slate-300 text-slate-900 focus:ring-slate-400/40 dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                                            >
                                            <span class="text-sm font-semibold text-slate-800 dark:text-slate-200">{{ $skill->getName() }}</span>
                                        </label>

                                        <div class="skill-details mt-4 space-y-3 {{ in_array($skill->id, $userSkills) ? '' : 'hidden' }}">
                                            <div>
                                                <label class="ui-label" for="skill_experience_{{ $skill->id }}">{{ __('Experience Level') }}</label>
                                                <select id="skill_experience_{{ $skill->id }}" name="skill_experience[{{ $skill->id }}]" class="ui-input">
                                                    <option value="beginner" {{ (old("skill_experience.{$skill->id}") ?? ($skillPivot[$skill->id]->pivot->experience_level ?? null)) == 'beginner' ? 'selected' : '' }}>{{ __('Beginner') }}</option>
                                                    <option value="intermediate" {{ (old("skill_experience.{$skill->id}") ?? ($skillPivot[$skill->id]->pivot->experience_level ?? null)) == 'intermediate' ? 'selected' : '' }}>{{ __('Intermediate') }}</option>
                                                    <option value="advanced" {{ (old("skill_experience.{$skill->id}") ?? ($skillPivot[$skill->id]->pivot->experience_level ?? null)) == 'advanced' ? 'selected' : '' }}>{{ __('Advanced') }}</option>
                                                    <option value="expert" {{ (old("skill_experience.{$skill->id}") ?? ($skillPivot[$skill->id]->pivot->experience_level ?? null)) == 'expert' ? 'selected' : '' }}>{{ __('Expert') }}</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="ui-label" for="skill_years_{{ $skill->id }}">{{ __('Years of Experience') }}</label>
                                                <input id="skill_years_{{ $skill->id }}" type="number" name="skill_years[{{ $skill->id }}]" min="0" max="50" value="{{ old("skill_years.{$skill->id}") ?? ($skillPivot[$skill->id]->pivot->years_experience ?? 0) }}" class="ui-input">
                                            </div>
                                            <div>
                                                <label class="ui-label" for="skill_description_{{ $skill->id }}">{{ __('Description') }}</label>
                                                <textarea id="skill_description_{{ $skill->id }}" name="skill_description[{{ $skill->id }}]" rows="2" class="ui-input" placeholder="{{ __('Brief description...') }}">{{ old("skill_description.{$skill->id}") ?? ($skillPivot[$skill->id]->pivot->description ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <a href="{{ localized_route('tasker.profile.show', $user->id) }}" class="ui-btn ui-btn-secondary">
                <i class="fa-regular fa-eye" aria-hidden="true"></i>
                <span>{{ __('View Profile') }}</span>
            </a>

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-end">
                <a href="{{ localized_route('dashboard') }}" class="ui-btn ui-btn-ghost">
                    <span>{{ __('Cancel') }}</span>
                </a>
                <button type="submit" class="ui-btn ui-btn-primary">
                    <i class="fa-regular fa-floppy-disk" aria-hidden="true"></i>
                    <span>{{ __('Save Changes') }}</span>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle skill checkbox changes
    const skillCheckboxes = document.querySelectorAll('.skill-checkbox');
    
    skillCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const skillDetails = this.closest('.skill-item').querySelector('.skill-details');
            if (this.checked) {
                skillDetails.classList.remove('hidden');
                // Optional: Scroll to details if needed or add animation class
            } else {
                skillDetails.classList.add('hidden');
            }
        });
    });
});
</script>
@endsection
