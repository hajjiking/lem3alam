import { defineConfig, devices } from '@playwright/test';

export default defineConfig({
    testDir: './playwright/tests',
    snapshotDir: './playwright/snapshots',
    workers: 1,
    expect: {
        toHaveScreenshot: {
            maxDiffPixelRatio: 0.01,
        },
    },
    use: {
        baseURL: 'http://127.0.0.1:8000',
        locale: 'en-US',
        timezoneId: 'UTC',
        colorScheme: 'light',
        reducedMotion: 'reduce',
    },
    webServer: {
        command: 'php artisan serve --host=127.0.0.1 --port=8000',
        url: 'http://127.0.0.1:8000',
        reuseExistingServer: true,
        timeout: 120_000,
        env: {
            APP_DEBUG: 'false',
        },
    },
    projects: [
        {
            name: 'chromium',
            use: { ...devices['Desktop Chrome'] },
        },
        {
            name: 'firefox',
            use: { ...devices['Desktop Firefox'] },
        },
        {
            name: 'webkit',
            use: { ...devices['Desktop Safari'] },
        },
        {
            name: 'chromium-mobile',
            use: { ...devices['Pixel 5'] },
        },
    ],
});
