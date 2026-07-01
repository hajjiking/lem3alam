import { expect, test } from '@playwright/test';

test.describe('Hero Header', () => {
    test('EN renders consistently', async ({ page }) => {
        await page.goto('/en', { waitUntil: 'networkidle' });
        const hero = page.locator('header.hero-header');
        await expect(hero).toBeVisible();
        await expect(hero).toHaveScreenshot('hero-header.en.png');

        const howItWorks = page.locator('#how-it-works');
        await expect(howItWorks).toBeVisible();
        await expect(howItWorks).toHaveScreenshot('how-it-works.en.png');

        const popularCategories = page.locator('section.popular-categories');
        await expect(popularCategories).toBeVisible();
        await expect(popularCategories).toHaveScreenshot('popular-categories.en.png');

        const trustSafety = page.locator('#trust-safety');
        await expect(trustSafety).toBeVisible();
        await expect(trustSafety).toHaveScreenshot('trust-safety.en.png');
    });

    test('AR (RTL) renders consistently', async ({ page }) => {
        await page.goto('/ar', { waitUntil: 'networkidle' });
        const hero = page.locator('header.hero-header');
        await expect(hero).toBeVisible();
        await expect(hero).toHaveScreenshot('hero-header.ar.png');

        const howItWorks = page.locator('#how-it-works');
        await expect(howItWorks).toBeVisible();
        await expect(howItWorks).toHaveScreenshot('how-it-works.ar.png');

        const popularCategories = page.locator('section.popular-categories');
        await expect(popularCategories).toBeVisible();
        await expect(popularCategories).toHaveScreenshot('popular-categories.ar.png');

        const trustSafety = page.locator('#trust-safety');
        await expect(trustSafety).toBeVisible();
        await expect(trustSafety).toHaveScreenshot('trust-safety.ar.png');
    });
});

test.describe('Client Dashboard', () => {
    test('Renders with clear sections (empty state)', async ({ page }, testInfo) => {
        const runId = `${testInfo.project.name}-${Date.now()}`;
        const email = `client+${runId}@example.test`;
        const phone = `06${Date.now()}${testInfo.workerIndex}`;

        await page.goto('/en/register', { waitUntil: 'networkidle' });
        await page.fill('#first_name', 'Test');
        await page.fill('#last_name', 'Client');
        await page.fill('#email', email);
        await page.fill('#phone', phone);
        await page.selectOption('#user_type', 'client');
        await page.fill('#password', 'Password123!');
        await page.fill('#password_confirmation', 'Password123!');
        await page.check('#terms');

        await Promise.all([
            page.waitForNavigation({ waitUntil: 'networkidle' }),
            page.click('button[type="submit"]'),
        ]);

        await page.goto('/en/dashboard/client', { waitUntil: 'networkidle' });

        await expect(page.getByRole('heading', { level: 1 })).toBeVisible();
        await expect(page.getByRole('link', { name: 'Create New Task' }).first()).toBeVisible();
        await expect(page.getByRole('heading', { name: 'Overview' })).toBeVisible();
        await expect(page.getByRole('heading', { name: 'Recent tasks' })).toBeVisible();

        const isMobileProject = testInfo.project.name.includes('mobile');
        const dashboardNav = page.locator('[data-dashboard-nav]');
        if (isMobileProject) {
            await expect(dashboardNav).toBeVisible();
        } else {
            await expect(dashboardNav).toBeHidden();
        }
    });
});
