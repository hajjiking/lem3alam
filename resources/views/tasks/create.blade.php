@extends('layouts.app')

@section('title', __('tasks.create_task'))

@section('content')
<div class="ui-fade-in max-w-5xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight">{{ __('tasks.create_new_task') }}</h1>
            <div class="ui-muted mt-1">{{ __('tasks.create_task_description') }}</div>
        </div>
        <a href="{{ localized_route('tasks.index') }}" class="ui-btn ui-btn-secondary">
            <i class="fa-solid fa-arrow-left rtl:rotate-180"></i>
            <span class="truncate">{{ __('tasks.cancel') ?? __('ui.back') }}</span>
        </a>
    </div>

    <div class="ui-card">
        <div class="ui-card-body">
            <form action="{{ localized_route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="taskCreateForm">
                @csrf

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="title" class="ui-label">{{ __('tasks.title') }}</label>
                        <input id="title" name="title" type="text" class="ui-input @error('title') border-rose-300 dark:border-rose-800 @enderror" value="{{ old('title') }}" placeholder="{{ __('tasks.title_placeholder') ?? 'e.g., Fix my leaky faucet' }}" required maxlength="200">
                        @error('title')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="ui-label">{{ __('tasks.category') }}</label>
                        <select id="category_id" name="category_id" class="ui-input @error('category_id') border-rose-300 dark:border-rose-800 @enderror" required>
                            <option value="">{{ __('tasks.select_category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->getName(app()->getLocale()) }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="urgency" class="ui-label">{{ __('tasks.urgency') ?? 'Urgency' }}</label>
                        <select id="urgency" name="urgency" class="ui-input @error('urgency') border-rose-300 dark:border-rose-800 @enderror" required>
                            <option value="low" @selected(old('urgency')==='low')>{{ __('tasks.low_urgency') ?? 'Low' }}</option>
                            <option value="medium" @selected(old('urgency','medium')==='medium')>{{ __('tasks.medium_urgency') ?? 'Medium' }}</option>
                            <option value="high" @selected(old('urgency')==='high')>{{ __('tasks.high_urgency') ?? 'High' }}</option>
                            <option value="urgent" @selected(old('urgency')==='urgent')>{{ __('tasks.urgent') ?? 'Urgent' }}</option>
                        </select>
                        @error('urgency')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description" class="ui-label">{{ __('tasks.description') }}</label>
                        <textarea id="description" name="description" rows="5" class="ui-input @error('description') border-rose-300 dark:border-rose-800 @enderror" placeholder="{{ __('tasks.description_placeholder') ?? 'Describe what you need done in detail…' }}" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="ui-divider"></div>

                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <label for="budget_type" class="ui-label">{{ __('tasks.budget_type') ?? 'Budget Type' }}</label>
                        <select id="budget_type" name="budget_type" class="ui-input @error('budget_type') border-rose-300 dark:border-rose-800 @enderror" required>
                            <option value="fixed" @selected(old('budget_type','fixed')==='fixed')>{{ __('tasks.fixed_amount') ?? 'Fixed Amount' }}</option>
                            <option value="hourly" @selected(old('budget_type')==='hourly')>{{ __('tasks.hourly') ?? 'Hourly' }}</option>
                            <option value="project" @selected(old('budget_type')==='project')>{{ __('tasks.per_project') ?? 'Per Project' }}</option>
                        </select>
                        @error('budget_type')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="budget_min" class="ui-label">{{ __('tasks.budget_min') ?? 'Minimum Budget' }}</label>
                        <input id="budget_min" name="budget_min" type="number" step="0.01" min="0" value="{{ old('budget_min') }}" class="ui-input @error('budget_min') border-rose-300 dark:border-rose-800 @enderror" placeholder="0" required>
                        @error('budget_min')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="budget_max" class="ui-label">{{ __('tasks.budget_max') ?? 'Maximum Budget' }}</label>
                        <input id="budget_max" name="budget_max" type="number" step="0.01" min="0" value="{{ old('budget_max') }}" class="ui-input @error('budget_max') border-rose-300 dark:border-rose-800 @enderror" placeholder="0">
                        @error('budget_max')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                        <div class="ui-muted mt-1">{{ __('tasks.budget_max_help') ?? 'Optional. If empty, uses minimum as maximum.' }}</div>
                    </div>
                    <div>
                        <label for="payment_method" class="ui-label">{{ __('tasks.payment_method') }}</label>
                        <select id="payment_method" name="payment_method" class="ui-input @error('payment_method') border-rose-300 dark:border-rose-800 @enderror" required>
                            <option value="">{{ __('tasks.select_payment_method') }}</option>
                            <option value="cash" @selected(old('payment_method','cash') === 'cash')>{{ __('tasks.payment_method_cash') }}</option>
                            <option value="card" @selected(old('payment_method') === 'card')>{{ __('tasks.payment_method_card') }}</option>
                            <option value="online" @selected(old('payment_method') === 'online')>{{ __('tasks.payment_method_online') }}</option>
                        </select>
                        @error('payment_method')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="ui-divider"></div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="relative">
                        <label for="location" class="ui-label">{{ __('tasks.location') ?? 'Location' }}</label>
                        <input id="location" name="location" type="text" value="{{ old('location') }}" class="ui-input @error('location') border-rose-300 dark:border-rose-800 @enderror" placeholder="{{ __('tasks.location_placeholder') ?? 'Search for a city…' }}" autocomplete="off">
                        @error('location')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                        <div id="cities-dropdown" class="absolute z-20 mt-2 hidden w-full ui-card">
                            <div class="max-h-56 overflow-auto p-2" id="cities-dropdown-items"></div>
                        </div>
                    </div>

                    <div>
                        <div class="ui-label">{{ __('tasks.work_type') ?? 'Work Type' }}</div>
                        <div class="mt-2 grid gap-2">
                            <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200/70 bg-white/60 px-3 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-white dark:border-slate-800/70 dark:bg-slate-950/40 dark:text-slate-200 dark:hover:bg-slate-950/60">
                                <input type="radio" name="is_remote" value="0" class="h-4 w-4 accent-slate-900 dark:accent-white" id="onsite" @checked(old('is_remote','0')==='0')>
                                <span class="truncate">{{ __('tasks.onsite_work') ?? 'On-site' }}</span>
                            </label>
                            <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200/70 bg-white/60 px-3 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-white dark:border-slate-800/70 dark:bg-slate-950/40 dark:text-slate-200 dark:hover:bg-slate-950/60">
                                <input type="radio" name="is_remote" value="1" class="h-4 w-4 accent-slate-900 dark:accent-white" id="remote" @checked(old('is_remote')==='1')>
                                <span class="truncate">{{ __('tasks.remote_work') ?? 'Remote' }}</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="deadline" class="ui-label">{{ __('tasks.deadline') ?? 'Deadline' }}</label>
                        <input id="deadline" name="deadline" type="date" value="{{ old('deadline') }}" class="ui-input @error('deadline') border-rose-300 dark:border-rose-800 @enderror">
                        @error('deadline')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="ui-label" for="skillInput">{{ __('tasks.required_skills') }}</label>
                        <div class="flex gap-2">
                            <input id="skillInput" type="text" class="ui-input" placeholder="{{ __('tasks.add_skill_placeholder') ?? 'Add a skill and press Add' }}">
                            <button type="button" id="addSkillBtn" class="ui-btn ui-btn-primary shrink-0">
                                <i class="fa-solid fa-plus"></i>
                                <span class="hidden sm:inline">{{ __('tasks.add') ?? 'Add' }}</span>
                            </button>
                        </div>
                        <div id="skillsList" class="mt-3 flex flex-wrap gap-2"></div>
                        @error('required_skills')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                        <div class="ui-muted mt-1">{{ __('tasks.skills_help') ?? 'Add keywords like React, Laravel, SEO' }}</div>
                    </div>
                </div>

                <div class="ui-divider"></div>

                <div>
                    <label for="images" class="ui-label">{{ __('tasks.attachments') }}</label>
                    <input type="file" name="images[]" id="images" class="ui-input @error('images') border-rose-300 dark:border-rose-800 @enderror" multiple accept="image/*">
                    @error('images')
                        <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                    @enderror
                    <div class="ui-muted mt-1">{{ __('tasks.attachments_help') ?? 'Upload images to help describe your task (optional)' }}</div>
                    <div id="previewError" class="mt-3 hidden rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 dark:border-rose-900/40 dark:bg-rose-900/25 dark:text-rose-200"></div>
                    <div id="preview" class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-4"></div>
                </div>

                <div class="flex flex-col-reverse gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ localized_route('tasks.index') }}" class="ui-btn ui-btn-ghost justify-center">
                        <span class="truncate">{{ __('tasks.cancel') ?? __('ui.cancel') }}</span>
                    </a>
                    <button type="submit" class="ui-btn ui-btn-primary justify-center" id="submitBtn">
                        <i class="fa-solid fa-plus"></i>
                        <span class="truncate">{{ __('tasks.create_task') ?? 'Create Task' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const locationInput = document.getElementById('location');
    const onsiteRadio = document.getElementById('onsite');
    const remoteRadio = document.getElementById('remote');
    const citiesDropdown = document.getElementById('cities-dropdown');
    const citiesDropdownItems = document.getElementById('cities-dropdown-items');
    const form = document.getElementById('taskCreateForm');
    const submitBtn = document.getElementById('submitBtn');

    function setCitiesDropdownOpen(open) {
        citiesDropdown.classList.toggle('hidden', !open);
    }

    function updateLocationRequirement() {
        if (remoteRadio && remoteRadio.checked) {
            locationInput.removeAttribute('required');
            locationInput.disabled = true;
            locationInput.value = '';
            setCitiesDropdownOpen(false);
        } else {
            locationInput.setAttribute('required', 'required');
            locationInput.disabled = false;
        }
    }

    onsiteRadio?.addEventListener('change', updateLocationRequirement);
    remoteRadio?.addEventListener('change', updateLocationRequirement);
    updateLocationRequirement();

    const skillInput = document.getElementById('skillInput');
    const addSkillBtn = document.getElementById('addSkillBtn');
    const skillsList = document.getElementById('skillsList');
    let skills = [];

    function removeSkill(skill) {
        skills = skills.filter(s => s !== skill);
        updateSkillsDisplay();
    }

    function updateSkillsDisplay() {
        skillsList.innerHTML = skills.map(skill =>
            `<span class="ui-badge border-slate-200 bg-white text-slate-700 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-200">
                ${skill}
                <button type="button" class="ms-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-slate-900 text-white dark:bg-white dark:text-slate-900" aria-label="Remove" onclick="removeSkill('${skill.replaceAll("'", "\\'")}')">×</button>
            </span>`
        ).join('');

        const existingInputs = document.querySelectorAll('input[name="required_skills[]"]');
        existingInputs.forEach((el) => el.remove());

        skills.forEach((skill) => {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'required_skills[]';
            hiddenInput.value = skill;
            skillsList.appendChild(hiddenInput);
        });
    }

    function addSkill() {
        const skill = (skillInput.value || '').trim();
        if (!skill) return;
        if (skills.includes(skill)) return;
        skills.push(skill);
        updateSkillsDisplay();
        skillInput.value = '';
        skillInput.focus();
    }

    window.removeSkill = removeSkill;

    addSkillBtn?.addEventListener('click', addSkill);
    skillInput?.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            addSkill();
        }
    });

    const previewError = document.getElementById('previewError');
    const imagesInput = document.getElementById('images');
    const preview = document.getElementById('preview');

    function showPreviewError(text) {
        if (!text) {
            previewError.classList.add('hidden');
            previewError.textContent = '';
            return;
        }
        previewError.textContent = text;
        previewError.classList.remove('hidden');
    }

    imagesInput?.addEventListener('change', () => {
        preview.innerHTML = '';
        showPreviewError('');
        const files = Array.from(imagesInput.files || []);
        if (files.length === 0) return;

        for (const file of files) {
            if (!file.type.startsWith('image/')) {
                showPreviewError(`"${file.name}" is not a valid image.`);
                continue;
            }
            if (file.size > 2048 * 1024) {
                showPreviewError(`"${file.name}" is too large. Max size is 2MB.`);
                continue;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                const src = e.target?.result;
                const item = document.createElement('div');
                item.className = 'ui-card overflow-hidden';
                item.innerHTML = `
                    <div class="p-2">
                        <img src="${src}" alt="" class="h-24 w-full rounded-xl object-cover">
                        <div class="mt-2 truncate text-xs font-semibold text-slate-600 dark:text-slate-300">${file.name}</div>
                    </div>
                `;
                preview.appendChild(item);
            };
            reader.readAsDataURL(file);
        }
    });

    form?.addEventListener('submit', () => {
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-80');
    });

    let allCities = [];

    function renderCityItems(cities) {
        if (!citiesDropdownItems) return;
        if (cities.length === 0) {
            citiesDropdownItems.innerHTML = `<div class="px-3 py-2 text-sm font-semibold text-slate-500 dark:text-slate-400">No cities found</div>`;
            return;
        }
        citiesDropdownItems.innerHTML = cities.map(city => `
            <button type="button" class="w-full rounded-xl px-3 py-2 text-start transition hover:bg-slate-50 dark:hover:bg-slate-900 city-item" data-city="${city.name}">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <div class="truncate text-sm font-extrabold text-slate-900 dark:text-white">${city.name}</div>
                        <div class="truncate text-xs font-semibold text-slate-500 dark:text-slate-400">${city.name_ar}</div>
                    </div>
                    <div class="shrink-0 text-xs font-semibold text-slate-500 dark:text-slate-400">${city.region}</div>
                </div>
            </button>
        `).join('');
    }

    fetch('/api/v1/cities/all')
        .then(r => r.json())
        .then(data => { if (data && data.success) allCities = data.data || []; })
        .catch(() => {});

    locationInput?.addEventListener('focus', () => {
        if (locationInput.disabled) return;
        renderCityItems(allCities.slice(0, 50));
        setCitiesDropdownOpen(true);
    });

    locationInput?.addEventListener('input', () => {
        if (locationInput.disabled) return;
        const query = (locationInput.value || '').toLowerCase().trim();
        const cities = query.length === 0
            ? allCities.slice(0, 50)
            : allCities.filter(city =>
                (city.name || '').toLowerCase().includes(query) ||
                (city.name_ar || '').toLowerCase().includes(query) ||
                (city.region || '').toLowerCase().includes(query)
            ).slice(0, 50);
        renderCityItems(cities);
        setCitiesDropdownOpen(true);
    });

    document.addEventListener('click', (e) => {
        if (!citiesDropdown.contains(e.target) && !locationInput.contains(e.target)) setCitiesDropdownOpen(false);
    });

    citiesDropdown?.addEventListener('click', (e) => {
        const item = e.target.closest('.city-item');
        if (!item) return;
        const cityName = item.getAttribute('data-city');
        if (!cityName) return;
        locationInput.value = cityName;
        setCitiesDropdownOpen(false);
    });
});
</script>
@endpush
@endsection
