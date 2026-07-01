# Responsive Improvements (Mobile)

## Changes Implemented

- Added a mobile hamburger navbar (<= 1024px) with tap-friendly toggle, smooth open/close animation, outside-click close, Esc close, and auto-close on navigation.
- Added global responsive defaults: fluid media, 16px minimum body text (1rem), focus-visible outlines, and device-aware hover handling to avoid touch “sticky hover”.
- Enforced minimum 44x44 tap targets for common interactive controls (buttons, nav links, dropdown items, pagination, inputs).
- Added responsive images on the Blog page using srcset/sizes plus decoding=async and lazy-loading for below-the-fold images.
- Updated the Admin layout to be touch-friendly (44x44 controls) and added the requested breakpoint rules (1024/768/480/320).

## Responsive Design Checklist (Maintenance)

### Layout

- Avoid fixed widths; prefer max-width with width: 100%, flex, or CSS grid.
- Add/verify breakpoint behavior at 1024px, 768px, 480px, and 320px.
- Ensure no horizontal scrolling at 320px (check overflow-x and long unbroken text).

### Typography

- Keep body text at 1rem (16px) minimum.
- Use scalable units (rem/em) and clamp() for headings where needed.
- Verify line-height stays readable (>= 1.5 for body).

### Touch & Accessibility

- Ensure all tap targets are at least 44x44.
- Ensure keyboard focus is visible via :focus-visible.
- Avoid hover-only interactions; provide click/tap equivalents and :active states.
- Confirm dropdowns, modals, and menus work without hover.

### Images & Media

- Use responsive images (srcset + sizes) for large/marketing images.
- Add loading="lazy" for below-the-fold images; keep above-the-fold images eager when appropriate.
- Prefer modern formats (WebP/AVIF) for local assets when available.

### Navigation

- Confirm hamburger opens/closes reliably, closes on navigation, and supports Esc/outside click.
- Confirm RTL layout behaves correctly (alignment, icon spacing).

### Performance (Mobile)

- Run a production build and verify CSS/JS are minified.
- Verify total JS/CSS payload stays reasonable and images aren’t the largest contributors.
- Re-check PageSpeed Insights after significant UI changes.
