# Hero Header Redesign (New Theme)

## Scope
- Component: Home page hero header in [home.blade.php](file:///c:/xampp/htdocs/m3alam/resources/views/home.blade.php)
- Styles: [app.css](file:///c:/xampp/htdocs/m3alam/resources/css/app.css) (`.hero-header*`, `.hero-btn-*`)

## What Changed
### Typography
- Replaced inline typography with theme-aligned sizing and weights (`text-4xl → text-6xl`, `tracking-tight`, balanced wrapping).
- Kept copy driven by existing i18n keys (`ui.hero_title`, `ui.hero_subtitle`, etc.).

### Color Scheme
- Standardized hero background to the existing brand gradient (`.page-hero-gradient`) and layered, subtle highlights via `.hero-header__bg`.
- Updated CTA styling to ensure consistent contrast on the gradient:
  - Primary: white button with dark text (`.hero-btn-primary`)
  - Secondary: translucent “glass” button with white text (`.hero-btn-secondary`)

### Spacing & Layout
- Rebuilt layout using responsive grid and spacing tokens (mobile-first, 2-column on `lg`).
- Consolidated the hero into a single header structure with predictable vertical rhythm.

### Imagery
- Replaced complex inline “particles/shapes” markup with a single decorative inline SVG panel (`.hero-header__art`).
- Decorative media is `aria-hidden` to avoid noise for assistive tech.

## Accessibility (WCAG 2.1 AA)
- Semantic structure: `<header>` + `<h1>` + descriptive body text + CTA links.
- Focus visible: uses existing theme focus ring from `.ui-btn` and global `:focus-visible`.
- Reduced motion: animation is disabled automatically for users with `prefers-reduced-motion: reduce` (`.hero-header__bg::after`, scroll chevron).
- Contrast: hero text and controls use high-contrast values against the gradient background.

## Style Guide Reference
- Design tokens: CSS variables in [app.css](file:///c:/xampp/htdocs/m3alam/resources/css/app.css) (`--primary-*`, `--accent-*`, spacing/radius/shadow tokens).
- UI primitives: `.ui-container`, `.ui-btn` and related variants in [app.css](file:///c:/xampp/htdocs/m3alam/resources/css/app.css).

## Visual Regression & Cross-Browser Verification
- Tooling: Playwright (`@playwright/test`)
- Config: [playwright.config.ts](file:///c:/xampp/htdocs/m3alam/playwright.config.ts)
- Specs: [hero-header.spec.ts](file:///c:/xampp/htdocs/m3alam/playwright/tests/hero-header.spec.ts)

### Run
```bash
npm install
npx playwright install
npm run build
npm run test:visual:update
npm run test:visual
```

