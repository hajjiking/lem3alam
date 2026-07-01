# Review Star Rating System

## Technical Specs
- Four criteria captured via 5-star inputs: quality, communication, timeliness, professionalism.
- Hidden inputs: `quality_rating`, `communication_rating`, `timeliness_rating`, `professionalism_rating`.
- Overall rating: rounded average of the four criteria, stored in `reviews.rating`.
- Criteria stored in `reviews.metadata.criteria`.
- Review model fields include: `client_id`, `tasker_id`, `task_id`, `reviewer_id`, `reviewee_id`, `type`, `status`, `comment`, `comment_translations`, `metadata`.
- Controller enforces: participant-only, one review per job, completed status, moderation.

## UI Behavior
- Click or keyboard (Enter/Space) selects stars; visual feedback via `.text-yellow-400` and `.text-gray-300`.
- Selected state persists until changed; hover previews revert on mouseleave to current selection.
- Initial state restored from previous input on validation errors.
- When not eligible, inputs disabled and an error message is shown with optional link to existing review.

## Submission
- Form posts to `reviews.store` with criteria and comment.
- Server validates 20–500 chars for comment and ratings 1–5 per criterion.
- On success, redirects to the tasker profile.

## Troubleshooting
- Stars not changing: ensure JavaScript is loading and no console errors; check the buttons aren’t disabled (eligibility required).
- Colors not updating: if `text-yellow-400`/`text-gray-300` styles are missing, confirm your CSS build includes them.
- Missing existing review link: appears only when a duplicate review is detected.
- Validation failures: messages appear inline; previous input values restore selection.

## Testing
- Feature test `tests/Feature/ReviewRatingTest.php` verifies criteria submission and overall rating.
- For cross-browser, confirm click/hover/keyboard interactions in Chrome, Firefox, Safari, Edge.
- Mobile: verify taps select stars; keyboard interactions apply for hardware keyboards.
