@extends('layouts.app')

@section('title', __('Add Portfolio Item'))

@section('content')
<div class="ui-fade-in max-w-4xl space-y-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div class="min-w-0">
            <h1 class="truncate text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Add Portfolio Item') }}</h1>
            <div class="ui-muted mt-1">{{ __('Showcase your work to attract more clients') }}</div>
        </div>
        <a href="{{ localized_route('tasker.portfolio.index') }}" class="ui-btn ui-btn-secondary">
            <i class="fa-solid fa-arrow-left rtl:rotate-180" aria-hidden="true"></i>
            <span>{{ __('Back to Portfolio') }}</span>
        </a>
    </div>

    @if($errors->any())
        <div class="ui-card border-rose-200/70 dark:border-rose-900/40">
            <div class="ui-card-body">
                <div class="text-sm font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Please fix the following errors') }}</div>
                <ul class="mt-2 list-disc ps-5 text-sm text-slate-700 dark:text-slate-200">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ localized_route('tasker.portfolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="ui-card overflow-hidden">
            <div class="border-b border-slate-200/70 px-6 py-5 dark:border-slate-800/70">
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-rectangle-list text-slate-400" aria-hidden="true"></i>
                    <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Basic Information') }}</h2>
                </div>
            </div>
            <div class="ui-card-body">
                <div class="space-y-5">
                    <div>
                        <label for="title" class="ui-label">{{ __('Title') }} <span class="text-rose-600">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required class="ui-input" placeholder="{{ __('e.g., Modern Kitchen Renovation') }}">
                    </div>

                    <div>
                        <label for="description" class="ui-label">{{ __('Description (French)') }} <span class="text-rose-600">*</span></label>
                        <textarea name="description" id="description" rows="4" required class="ui-input" placeholder="{{ __('Describe the project, what you did, challenges faced, and results achieved...') }}">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="description_ar" class="ui-label">{{ __('Description (Arabic)') }}</label>
                        <textarea name="description_ar" id="description_ar" rows="4" class="ui-input" dir="rtl" placeholder="{{ __('وصف المشروع باللغة العربية...') }}">{{ old('description_ar') }}</textarea>
                    </div>

                    <div>
                        <label for="image" class="ui-label">{{ __('Project Image') }} <span class="text-rose-600">*</span></label>
                        <div class="rounded-2xl border border-dashed border-slate-200/70 bg-white/50 p-6 text-center shadow-sm backdrop-blur transition hover:bg-white/70 dark:border-slate-800/70 dark:bg-slate-950/30 dark:hover:bg-slate-950/40">
                            <input type="file" name="image" id="image" accept="image/*" required class="hidden" onchange="previewImage(this)">
                            <label for="image" class="cursor-pointer">
                                <div id="image-preview" class="hidden">
                                    <img id="preview-img" src="" alt="{{ __('Preview') }}" class="mx-auto h-48 max-w-full rounded-2xl object-cover">
                                    <div class="ui-muted mt-3 text-sm">{{ __('Click to change image') }}</div>
                                </div>
                                <div id="image-placeholder">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-900/40">
                                        <i class="fa-regular fa-image" aria-hidden="true"></i>
                                    </div>
                                    <div class="mt-3 text-sm font-semibold text-slate-900 dark:text-white">{{ __('Click to upload an image') }}</div>
                                    <div class="ui-muted mt-1 text-xs">{{ __('PNG, JPG, GIF up to 5MB') }}</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="image_alt" class="ui-label">{{ __('Image Alt Text') }}</label>
                        <input type="text" name="image_alt" id="image_alt" value="{{ old('image_alt') }}" class="ui-input" placeholder="{{ __('Describe the image for accessibility') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="ui-card overflow-hidden">
            <div class="border-b border-slate-200/70 px-6 py-5 dark:border-slate-800/70">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-tags text-slate-400" aria-hidden="true"></i>
                    <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Categorization') }}</h2>
                </div>
            </div>
            <div class="ui-card-body">
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="category_id" class="ui-label">{{ __('Category') }}</label>
                        <select name="category_id" id="category_id" class="ui-input">
                            <option value="">{{ __('Select a category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="task_id" class="ui-label">{{ __('Related Task (Optional)') }}</label>
                        <select name="task_id" id="task_id" class="ui-input">
                            <option value="">{{ __('Select a task') }}</option>
                            @foreach($userTasks as $task)
                                <option value="{{ $task->id }}" {{ old('task_id') == $task->id ? 'selected' : '' }}>{{ $task->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="tags" class="ui-label">{{ __('Tags') }}</label>
                        <input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="ui-input" placeholder="{{ __('e.g., renovation, kitchen, modern (separate with commas)') }}">
                        <div class="ui-muted mt-2 text-xs">{{ __('Separate tags with commas') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui-card overflow-hidden">
            <div class="border-b border-slate-200/70 px-6 py-5 dark:border-slate-800/70">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-gear text-slate-400" aria-hidden="true"></i>
                    <h2 class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">{{ __('Settings') }}</h2>
                </div>
            </div>
            <div class="ui-card-body">
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="status" class="ui-label">{{ __('Status') }}</label>
                        <select name="status" id="status" class="ui-input">
                            <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                        </select>
                    </div>

                    <div>
                        <label for="display_order" class="ui-label">{{ __('Display Order') }}</label>
                        <input type="number" name="display_order" id="display_order" min="0" value="{{ old('display_order', 0) }}" class="ui-input" placeholder="0">
                        <div class="ui-muted mt-2 text-xs">{{ __('Lower numbers appear first') }}</div>
                    </div>
                </div>

                <div class="mt-5">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400/40 dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ __('Feature this portfolio item') }}</span>
                    </label>
                    <div class="ui-muted mt-2 text-xs">{{ __('Featured items appear prominently on your profile') }}</div>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-end">
            <button type="submit" name="action" value="draft" class="ui-btn ui-btn-secondary">
                <i class="fa-regular fa-file" aria-hidden="true"></i>
                <span>{{ __('Save as Draft') }}</span>
            </button>
            <button type="submit" name="action" value="publish" class="ui-btn ui-btn-primary">
                <i class="fa-solid fa-upload" aria-hidden="true"></i>
                <span>{{ __('Publish') }}</span>
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('image-placeholder').classList.add('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
