// Register service worker only in secure contexts
if ('serviceWorker' in navigator) {
    // Check if we're in a secure context (HTTPS or localhost)
    if (location.protocol === 'https:' || location.hostname === 'localhost' || location.hostname === '127.0.0.1') {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/build/sw.js', { scope: '/' })
                .then(function(registration) {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    console.log('ServiceWorker registration failed: ', err);
                });
        });
    } else {
        console.log('ServiceWorker not registered: Insecure context (requires HTTPS or localhost)');
    }
}