import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

const root = document.documentElement;

function applyTheme(theme) {
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const useDark = theme ? theme === 'dark' : prefersDark;
    root.classList.toggle('dark', useDark);
    root.dataset.theme = useDark ? 'dark' : 'light';
    const tokens = getThemeTokens();
    applyChartDefaults(tokens);
    document.dispatchEvent(new CustomEvent('app:theme-changed', { detail: tokens }));
}

function getThemeTokens() {
    const isDark = root.classList.contains('dark');
    return {
        isDark,
        text: isDark ? '#e2e8f0' : '#0f172a',
        muted: isDark ? '#94a3b8' : '#475569',
        grid: isDark ? 'rgba(148,163,184,0.25)' : 'rgba(148,163,184,0.35)',
        border: isDark ? 'rgba(148,163,184,0.28)' : 'rgba(148,163,184,0.40)',
        surface: isDark ? '#020617' : '#ffffff',
    };
}

function applyChartDefaults(tokens) {
    const Chart = window.Chart;
    if (!Chart || !Chart.defaults) return;
    Chart.defaults.color = tokens.muted;
    Chart.defaults.borderColor = tokens.grid;
    if (Chart.defaults.plugins?.legend?.labels) {
        Chart.defaults.plugins.legend.labels.color = tokens.muted;
    }
    if (Chart.defaults.scale?.ticks) {
        Chart.defaults.scale.ticks.color = tokens.muted;
    }
    if (Chart.defaults.scale?.grid) {
        Chart.defaults.scale.grid.color = tokens.grid;
    }
}

function initTheme() {
    const saved = localStorage.getItem('theme');
    applyTheme(saved);

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-theme-toggle]');
        if (!btn) return;
        const current = root.classList.contains('dark') ? 'dark' : 'light';
        const next = current === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', next);
        applyTheme(next);
        btn.setAttribute('aria-pressed', next === 'dark' ? 'true' : 'false');
    });
}

function initSidebar() {
    document.addEventListener('click', (e) => {
        const toggle = e.target.closest('[data-sidebar-toggle]');
        if (!toggle) return;
        root.classList.toggle('sidebar-collapsed');
        localStorage.setItem('sidebar', root.classList.contains('sidebar-collapsed') ? 'collapsed' : 'expanded');
    });

    const saved = localStorage.getItem('sidebar');
    if (saved === 'collapsed') root.classList.add('sidebar-collapsed');
}

function initMobileNav() {
    document.addEventListener('click', (e) => {
        const toggle = e.target.closest('[data-mobile-nav-toggle]');
        if (!toggle) return;
        const id = toggle.getAttribute('data-mobile-nav-toggle');
        if (!id) return;
        const panel = document.getElementById(id);
        if (!panel) return;
        panel.classList.toggle('hidden');
        toggle.setAttribute('aria-expanded', panel.classList.contains('hidden') ? 'false' : 'true');
    });
}

function initDismiss() {
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-dismiss]');
        if (!btn) return;
        const selector = btn.getAttribute('data-dismiss');
        const el = selector ? document.querySelector(selector) : btn.closest('[data-dismissible]');
        if (!el) return;
        el.remove();
    });
}

function initCategoryColors() {
    const els = document.querySelectorAll('[data-cat-color]');
    els.forEach((el) => {
        const value = (el.getAttribute('data-cat-color') || '').trim();
        const color = /^#[0-9a-fA-F]{6}$/.test(value) ? value : '#0f172a';
        el.style.setProperty('--cat-color', color);
    });
}

window.__lem3alamTheme = { get: getThemeTokens };

initTheme();
initSidebar();
initMobileNav();
initDismiss();
initCategoryColors();
