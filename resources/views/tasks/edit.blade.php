@extends('layouts.app')

@section('title', __('tasks.edit_task'))

@section('content')
@php
    $initialSkills = old('required_skills', $task->required_skills ?? []);
    if (!is_array($initialSkills)) $initialSkills = [];
    $initialDeadline = old('deadline', optional($task->deadline)->format('Y-m-d'));
@endphp

<div class="ui-fade-in max-w-5xl">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-extrabold tracking-tight">{{ __('tasks.edit_task') }}</h1>
            <div class="ui-muted mt-1">{{ __('tasks.edit_task_description') }}</div>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ localized_route('tasks.show', $task->id) }}" class="ui-btn ui-btn-secondary">
                <i class="fa-solid fa-arrow-left rtl:rotate-180"></i>
                <span class="truncate">{{ __('ui.back') }}</span>
            </a>
        </div>
    </div>

    <div class="ui-card">
        <div class="ui-card-body">
            <form action="{{ localized_route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="taskEditForm" data-initial-skills='@json($initialSkills)'>
                @csrf
                @method('PUT')

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="title" class="ui-label">{{ __('tasks.title') }}</label>
                        <input id="title" name="title" type="text" class="ui-input @error('title') border-rose-300 dark:border-rose-800 @enderror" value="{{ old('title', $task->title) }}" placeholder="{{ __('tasks.title_placeholder') }}" required maxlength="255">
                        @error('title')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description" class="ui-label">{{ __('tasks.description') }}</label>
                        <textarea id="description" name="description" rows="6" class="ui-input @error('description') border-rose-300 dark:border-rose-800 @enderror" placeholder="{{ __('tasks.description_placeholder') }}" required>{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="ui-divider"></div>

                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <label for="category_id" class="ui-label">{{ __('tasks.category') }}</label>
                        <select id="category_id" name="category_id" class="ui-input @error('category_id') border-rose-300 dark:border-rose-800 @enderror" required>
                            <option value="">{{ __('tasks.select_category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->getName(app()->getLocale()) }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="budget_type" class="ui-label">{{ __('tasks.budget_type') }}</label>
                        <select id="budget_type" name="budget_type" class="ui-input @error('budget_type') border-rose-300 dark:border-rose-800 @enderror" required>
                            <option value="fixed" @selected(old('budget_type', $task->budget_type) === 'fixed')>{{ __('tasks.fixed_price') ?? __('tasks.fixed_amount') ?? 'Fixed' }}</option>
                            <option value="hourly" @selected(old('budget_type', $task->budget_type) === 'hourly')>{{ __('tasks.hourly_rate') ?? __('tasks.hourly') ?? 'Hourly' }}</option>
                            <option value="project" @selected(old('budget_type', $task->budget_type) === 'project')>{{ __('tasks.project_based') ?? __('tasks.per_project') ?? 'Project' }}</option>
                        </select>
                        @error('budget_type')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="budget_min" class="ui-label">{{ __('tasks.budget_min') }}</label>
                        <input id="budget_min" name="budget_min" type="number" step="0.01" min="0" class="ui-input @error('budget_min') border-rose-300 dark:border-rose-800 @enderror" value="{{ old('budget_min', $task->budget_min) }}" required>
                        @error('budget_min')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="budget_max" class="ui-label">{{ __('tasks.budget_max') }}</label>
                        <input id="budget_max" name="budget_max" type="number" step="0.01" min="0" class="ui-input @error('budget_max') border-rose-300 dark:border-rose-800 @enderror" value="{{ old('budget_max', $task->budget_max) }}">
                        @error('budget_max')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="payment_method" class="ui-label">{{ __('tasks.payment_method') }}</label>
                        @php($currentPaymentMethod = old('payment_method', $task->payment_method ?? 'cash'))
                        <select id="payment_method" name="payment_method" class="ui-input @error('payment_method') border-rose-300 dark:border-rose-800 @enderror" required>
                            <option value="cash" @selected($currentPaymentMethod === 'cash')>{{ __('tasks.payment_method_cash') }}</option>
                            <option value="card" @selected($currentPaymentMethod === 'card')>{{ __('tasks.payment_method_card') }}</option>
                            <option value="online" @selected($currentPaymentMethod === 'online')>{{ __('tasks.payment_method_online') }}</option>
                        </select>
                        @error('payment_method')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="urgency" class="ui-label">{{ __('tasks.urgency') }}</label>
                        <select id="urgency" name="urgency" class="ui-input @error('urgency') border-rose-300 dark:border-rose-800 @enderror" required>
                            <option value="low" @selected(old('urgency', $task->urgency) === 'low')>{{ __('tasks.low_urgency') ?? 'Low' }}</option>
                            <option value="medium" @selected(old('urgency', $task->urgency) === 'medium')>{{ __('tasks.medium_urgency') ?? 'Medium' }}</option>
                            <option value="high" @selected(old('urgency', $task->urgency) === 'high')>{{ __('tasks.high_urgency') ?? 'High' }}</option>
                            <option value="urgent" @selected(old('urgency', $task->urgency) === 'urgent')>{{ __('tasks.urgent') ?? 'Urgent' }}</option>
                        </select>
                        @error('urgency')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="ui-divider"></div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="location" class="ui-label">{{ __('tasks.location') }}</label>
                        <input id="location" name="location" type="text" class="ui-input @error('location') border-rose-300 dark:border-rose-800 @enderror" value="{{ old('location', $task->location) }}" placeholder="{{ __('tasks.location_placeholder') }}">
                        @error('location')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                        <div class="ui-muted mt-1">{{ __('tasks.location_help') ?? __('Leave empty for remote work.') }}</div>
                    </div>

                    <div>
                        <div class="ui-label">{{ __('tasks.work_type') }}</div>
                        <div class="mt-2 grid gap-2">
                            <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200/70 bg-white/60 px-3 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-white dark:border-slate-800/70 dark:bg-slate-950/40 dark:text-slate-200 dark:hover:bg-slate-950/60">
                                <input type="radio" name="is_remote" value="0" class="h-4 w-4 accent-slate-900 dark:accent-white" id="onsite" @checked(old('is_remote', $task->is_remote ? '1' : '0') === '0')>
                                <span class="truncate">{{ __('tasks.onsite_work') ?? 'On-site' }}</span>
                            </label>
                            <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200/70 bg-white/60 px-3 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-white dark:border-slate-800/70 dark:bg-slate-950/40 dark:text-slate-200 dark:hover:bg-slate-950/60">
                                <input type="radio" name="is_remote" value="1" class="h-4 w-4 accent-slate-900 dark:accent-white" id="remote" @checked(old('is_remote', $task->is_remote ? '1' : '0') === '1')>
                                <span class="truncate">{{ __('tasks.remote_work') ?? 'Remote' }}</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="deadline" class="ui-label">{{ __('tasks.deadline') }}</label>
                        <input id="deadline" name="deadline" type="date" class="ui-input @error('deadline') border-rose-300 dark:border-rose-800 @enderror" value="{{ $initialDeadline }}">
                        @error('deadline')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="ui-label" for="skillInput">{{ __('tasks.required_skills') }}</label>
                        <div class="flex gap-2">
                            <input id="skillInput" type="text" class="ui-input" placeholder="{{ __('tasks.add_skill_placeholder') ?? __('tasks.skill_placeholder') }}">
                            <button type="button" id="addSkillBtn" class="ui-btn ui-btn-primary shrink-0">
                                <i class="fa-solid fa-plus"></i>
                                <span class="hidden sm:inline">{{ __('tasks.add_skill') ?? __('tasks.add') ?? 'Add' }}</span>
                            </button>
                        </div>
                        <div id="skillsList" class="mt-3 flex flex-wrap gap-2"></div>
                        @error('required_skills')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                        @error('required_skills.*')
                            <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="ui-divider"></div>

                <div>
                    <label for="images" class="ui-label">{{ __('tasks.attached_images') ?? __('tasks.attachments') }}</label>
                    @php($existingImages = (array) ($task->images ?? []))
                    @if(!empty($existingImages))
                        <div class="ui-muted mb-3">{{ __('tasks.images_replace_notice') ?? __('Uploading new images will replace existing ones.') }}</div>
                        <div class="mb-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
                            @foreach($existingImages as $img)
                                <a href="{{ asset('storage/' . $img) }}" target="_blank" rel="noopener" class="ui-card overflow-hidden">
                                    <div class="p-2">
                                        <img src="{{ asset('storage/' . $img) }}" alt="" class="h-24 w-full rounded-xl object-cover">
                                        <div class="mt-2 truncate text-xs font-semibold text-slate-600 dark:text-slate-300">{{ basename($img) }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <input type="file" name="images[]" id="images" class="ui-input @error('images') border-rose-300 dark:border-rose-800 @enderror" multiple accept="image/*">
                    @error('images')
                        <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                    @enderror
                    @error('images.*')
                        <div class="mt-1 text-sm font-semibold text-rose-600 dark:text-rose-300">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col-reverse gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ localized_route('tasks.show', $task->id) }}" class="ui-btn ui-btn-ghost justify-center">
                        <span class="truncate">{{ __('ui.cancel') }}</span>
                    </a>
                    <button type="submit" class="ui-btn ui-btn-primary justify-center" id="submitBtn">
                        <i class="fa-regular fa-floppy-disk"></i>
                        <span class="truncate">{{ __('tasks.update_task') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('taskEditForm');
    const submitBtn = document.getElementById('submitBtn');
    const skillInput = document.getElementById('skillInput');
    const addSkillBtn = document.getElementById('addSkillBtn');
    const skillsList = document.getElementById('skillsList');

    let skills = [];
    try {
        const raw = form?.getAttribute('data-initial-skills');
        const parsed = raw ? JSON.parse(raw) : [];
        skills = Array.isArray(parsed) ? parsed.filter(Boolean) : [];
    } catch (_) {
        skills = [];
    }

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
    updateSkillsDisplay();

    addSkillBtn?.addEventListener('click', addSkill);
    skillInput?.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            addSkill();
        }
    });

    form?.addEventListener('submit', () => {
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-80');
    });
});
</script>
@endpush
@endsection
