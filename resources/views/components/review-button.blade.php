@php
    $targetUrl = $url ?? localized_route('tasks.show', 4);
@endphp
<div class="d-flex align-items-center gap-2">
    <button type="button"
            class="btn btn-primary"
            aria-label="Review"
            tabindex="0"
            data-url="{{ $targetUrl }}">
        <i class="fas fa-star"></i> Review
    </button>
    <a href="{{ $targetUrl }}" class="d-none" id="review-fallback-link">Review</a>
</div>
<div class="alert alert-danger d-none mt-2" role="alert" id="review-error">
    Navigation failed. Please try again or use the fallback link.
    <a href="{{ $targetUrl }}" class="alert-link">Open</a>
    <span class="ms-2 text-muted">Error Code: RB001</span>
    <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="document.getElementById('review-error').classList.add('d-none')">Dismiss</button>
    <div class="mt-2">
        <small class="text-muted">Your session remains active.</small>
    </div>
</div>
<script>
    (function() {
        var btn = document.currentScript.previousElementSibling.previousElementSibling.querySelector('button.btn.btn-primary');
        var errorEl = document.currentScript.previousElementSibling;
        var fallback = btn.parentElement.querySelector('#review-fallback-link');
        function navigate() {
            var url = btn.getAttribute('data-url');
            try {
                if (!url) throw new Error('Missing URL');
                window.location.assign(url);
            } catch (e) {
                errorEl.classList.remove('d-none');
                if (fallback) fallback.click();
            }
        }
        btn.addEventListener('click', navigate);
        btn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                navigate();
            }
        });
    })();
</script>
