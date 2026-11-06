/**
 * AR Holidays Cheetah Instant Navigation Engine
 * Pre-fetches pages on hover and swaps content instantaneously (0-50ms)
 * without re-downloading or re-parsing render-blocking CDNs (Tailwind, Fonts, Icons).
 */
(function () {
    // Cache for pre-fetched HTML pages
    const pageCache = new Map();

    function isEligibleLink(anchor) {
        if (!anchor || anchor.tagName !== 'A') return false;
        const href = anchor.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('javascript:')) return false;
        if (anchor.target && anchor.target !== '_self') return false;
        if (anchor.hasAttribute('download') || anchor.hasAttribute('data-no-instant')) return false;

        // Don't intercept logout form links or modal triggers
        if (anchor.closest('form') || anchor.hasAttribute('onclick')) return false;

        try {
            const url = new URL(anchor.href, window.location.origin);
            return url.origin === window.location.origin;
        } catch {
            return false;
        }
    }

    // Pre-fetch on mouse hover
    function prefetchUrl(url) {
        if (pageCache.has(url)) return;
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => {
                if (res.ok) return res.text();
                throw new Error('Not ok');
            })
            .then(html => {
                pageCache.set(url, html);
            })
            .catch(() => {});
    }

    // Execute scripts inside swapped container
    function runScripts(container) {
        const scripts = container.querySelectorAll('script');
        scripts.forEach(oldScript => {
            const newScript = document.createElement('script');
            Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
            newScript.textContent = oldScript.textContent;
            oldScript.parentNode.replaceChild(newScript, oldScript);
        });
    }

    // Perform Instant Navigation
    async function navigateTo(url, pushState = true) {
        let html = pageCache.get(url);

        // Progress bar
        let progress = document.getElementById('cheetah-progress');
        if (!progress) {
            progress = document.createElement('div');
            progress.id = 'cheetah-progress';
            progress.className = 'fixed top-0 left-0 h-1 bg-gradient-to-r from-red-600 via-rose-500 to-amber-500 z-[9999] transition-all duration-200 pointer-events-none shadow-sm';
            document.body.appendChild(progress);
        }
        progress.style.width = '35%';
        progress.style.opacity = '1';

        try {
            if (!html) {
                const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                if (!res.ok) throw new Error('Fetch failed');
                html = await res.text();
                pageCache.set(url, html);
            }
            progress.style.width = '75%';

            const parser = new DOMParser();
            const newDoc = parser.parseFromString(html, 'text/html');

            // Swap Title
            if (newDoc.title) {
                document.title = newDoc.title;
            }

            // Swap Main Viewport
            const currentMain = document.querySelector('main');
            const newMain = newDoc.querySelector('main');
            if (currentMain && newMain) {
                currentMain.innerHTML = newMain.innerHTML;
                runScripts(currentMain);
            } else {
                window.location.href = url;
                return;
            }

            // Update Header (Active pills, counts, search)
            const currentHeader = document.querySelector('header');
            const newHeader = newDoc.querySelector('header');
            if (currentHeader && newHeader) {
                currentHeader.innerHTML = newHeader.innerHTML;
            }

            // Update Sidebar (Active state indicators & badges)
            const currentSidebar = document.getElementById('main-sidebar');
            const newSidebar = newDoc.getElementById('main-sidebar');
            if (currentSidebar && newSidebar) {
                currentSidebar.innerHTML = newSidebar.innerHTML;
            }

            if (pushState) {
                history.pushState({ url }, '', url);
            }

            window.scrollTo({ top: 0, behavior: 'instant' });

            progress.style.width = '100%';
            setTimeout(() => {
                progress.style.opacity = '0';
                setTimeout(() => { progress.style.width = '0%'; }, 200);
            }, 100);

            // Re-trigger DOM ready handlers for initialized components
            document.dispatchEvent(new Event('DOMContentLoaded'));
            window.dispatchEvent(new Event('load'));

        } catch (e) {
            window.location.href = url;
        }
    }

    // Attach global listeners
    document.addEventListener('mouseover', function (e) {
        const a = e.target.closest('a');
        if (isEligibleLink(a)) {
            prefetchUrl(a.href);
        }
    });

    document.addEventListener('touchstart', function (e) {
        const a = e.target.closest('a');
        if (isEligibleLink(a)) {
            prefetchUrl(a.href);
        }
    }, { passive: true });

    document.addEventListener('click', function (e) {
        const a = e.target.closest('a');
        if (isEligibleLink(a)) {
            // Ignore Ctrl+Click, Cmd+Click, Shift+Click, right click
            if (e.ctrlKey || e.metaKey || e.shiftKey || e.button !== 0) return;
            e.preventDefault();
            navigateTo(a.href, true);
        }
    });

    window.addEventListener('popstate', function () {
        navigateTo(window.location.href, false);
    });
})();

