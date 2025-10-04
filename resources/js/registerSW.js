// Register service worker only in secure contexts
function registerServiceWorker() {
    if ('serviceWorker' in navigator) {
        // Check if we're in a secure context (HTTPS or localhost)
        if (location.protocol === 'https:' || location.hostname === 'localhost' || location.hostname === '127.0.0.1') {
            console.log('Registering service worker...');
            
            // Register with /build/ scope directly to avoid security issues
            navigator.serviceWorker.register('/build/sw.js', { scope: '/build/' })
                .then(function(registration) {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    
                    // Check for updates
                    registration.addEventListener('updatefound', () => {
                        const newWorker = registration.installing;
                        newWorker.addEventListener('statechange', () => {
                            if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                console.log('New content is available; please refresh.');
                            }
                        });
                    });
                })
                .catch(function(err) {
                    console.error('ServiceWorker registration failed: ', err);
                });
        } else {
            console.log('ServiceWorker not registered: Insecure context (requires HTTPS or localhost)');
        }
    } else {
        console.log('ServiceWorker not supported by this browser');
    }
}

// Execute when DOM is loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', registerServiceWorker);
} else {
    registerServiceWorker();
}