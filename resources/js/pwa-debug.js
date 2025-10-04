// PWA Diagnostic Script
console.log('=== PWA Diagnostic ===');

// Check basic PWA requirements
function checkPWASupport() {
    console.log('🔍 Checking PWA Support...');
    
    // Service Worker support
    console.log('ServiceWorker support:', 'serviceWorker' in navigator);
    
    // Secure context
    console.log('Secure context (HTTPS):', location.protocol === 'https:' || location.hostname === 'localhost');
    console.log('Current protocol:', location.protocol);
    console.log('Current hostname:', location.hostname);
    
    // Manifest
    const manifestLink = document.querySelector('link[rel="manifest"]');
    console.log('Manifest link found:', !!manifestLink);
    if (manifestLink) {
        console.log('Manifest URL:', manifestLink.href);
        
        // Test manifest accessibility
        fetch(manifestLink.href)
            .then(response => {
                console.log('Manifest accessible:', response.ok);
                if (response.ok) {
                    return response.json();
                }
                throw new Error(`HTTP ${response.status}`);
            })
            .then(manifest => {
                console.log('Manifest content:', manifest);
            })
            .catch(error => {
                console.error('Manifest error:', error);
            });
    }
    
    // Check Service Worker files
    const swUrls = ['/sw.js', '/build/sw.js'];
    swUrls.forEach(url => {
        fetch(url)
            .then(response => {
                console.log(`Service Worker ${url} accessible:`, response.ok);
            })
            .catch(error => {
                console.log(`Service Worker ${url} not accessible:`, error.message);
            });
    });
    
    // Check if app is installable
    console.log('Install prompt available:', !!window.deferredPrompt);
    
    // Check current registration
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.getRegistrations()
            .then(registrations => {
                console.log('Active Service Workers:', registrations.length);
                registrations.forEach((registration, index) => {
                    console.log(`SW ${index + 1}:`, {
                        scope: registration.scope,
                        state: registration.active?.state,
                        scriptURL: registration.active?.scriptURL
                    });
                });
            });
    }
    
    // Check installation status
    window.addEventListener('beforeinstallprompt', (e) => {
        console.log('✅ App is installable!');
    });
    
    window.addEventListener('appinstalled', (e) => {
        console.log('✅ App was installed!');
    });
    
    // Check if running as PWA
    const isStandalone = window.matchMedia('(display-mode: standalone)').matches;
    console.log('Running as PWA:', isStandalone);
}

// Run diagnostics
checkPWASupport();

// Re-run after 2 seconds to check registration status
setTimeout(checkPWASupport, 2000);