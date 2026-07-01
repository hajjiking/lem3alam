## Current State

* Profile edit is implemented: `TaskerProfileController@edit/update` and routes `tasker.profile.edit/update` in `routes/web.php:194–195`.

* Portfolio CRUD exists: `TaskerProfileController@portfolio*` and routes `tasker.portfolio.*` in `routes/web.php:198–203`.

* Public tasker profile shows rating, reviews and portfolio: `resources/views/tasker/profile/show.blade.php` with stars and reviews.

* Reviews model/controller/routes exist and update tasker `rating` and `total_reviews`.

## What We Will Deliver

1. Profile editing UX

* Add clear entry points in the logged-in nav and dashboard for taskers: `Edit Profile` and `Manage Portfolio` (links to `tasker.profile.edit` and `tasker.portfolio.index`).

* Ensure fields cover bio, hourly rate, phone, city, address and `profile_image` upload; keep validation consistent.

1. Portfolio photos of previous tasks

* Use existing `portfolio.create/edit` to upload images to `public/portfolio` with alt text, category, tags, and optional `task_id` linking to completed tasks.

* Display on the public profile portfolio grid with pagination.

1. Public reviews and star ratings

* Confirm public route `tasker.profile.show` renders:

  * Average star rating and total reviews from `User::rating/total_reviews`.

  * Latest approved reviews with per-review stars.

* Add a `View all reviews` link to `reviews.index` under the Reviews section.

1. Permissions and safety

* Keep role middleware: only taskers manage profile/portfolio; only clients create reviews.

* Enforce image constraints (type/size) and store on `public` disk; no exposure of private paths.

1. UI polish

* Ensure consistent RTL/LTR and translations for new labels.

* Align portfolio cards and review list styles with existing design system.

1. Verification

* Manual flow tests:

  * Tasker edits profile and uploads portfolio images; changes reflect on profile.

  * Client views tasker profile, sees stars, portfolio, and reviews.

  * Client submits a review; average rating updates and appears publicly.

* Storage symlink check: run `php artisan storage:link` if not yet linked.

## Acceptance Criteria

* Taskers can edit profile and upload portfolio photos linked to past tasks.

* Other clients can view portfolio, average stars, and individual reviews on the public tasker profile.

* Navigation provides clear access to edit profile and manage portfolio for taskers.

* Validations and role restrictions enforced; images load from the `public` disk with proper URLs.

