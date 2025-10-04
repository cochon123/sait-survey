// Register service worker only in secure contexts
function registerServiceWorker() {
    if ('serviceWorker' in navigator) {
        // Check if we're in a secure context (HTTPS or localhost)
        if (location.protocol === 'https:' || location.hostname === 'localhost' || location.hostname === '127.0.0.1') {
            console.log('Registering service worker...');
            
            // First, clean up any existing registrations with wrong scope
            navigator.serviceWorker.getRegistrations().then(function(registrations) {
                // Unregister any SW not in root scope
                registrations.forEach(function(registration) {
                    if (registration.scope !== location.origin + '/') {
                        console.log('Cleaning up old registration:', registration.scope);
                        registration.unregister();
                    }
                });
                
                // Then register the correct one at root
                return navigator.serviceWorker.register('/sw.js', { scope: '/' });
            })
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

// PWA Install button functionality
let deferredPrompt;
const installButton = document.getElementById('installPWA');

// Listen for the beforeinstallprompt event
window.addEventListener('beforeinstallprompt', (e) => {
    console.log('PWA install prompt available');
    // Prevent Chrome 67 and earlier from automatically showing the prompt
    e.preventDefault();
    // Stash the event so it can be triggered later
    deferredPrompt = e;
    // Show the install button
    if (installButton) {
        installButton.style.display = 'block';
        installButton.classList.remove('hidden');
    }
});

// Handle install button click
if (installButton) {
    installButton.addEventListener('click', async () => {
        if (deferredPrompt) {
            // Show the install prompt
            deferredPrompt.prompt();
            // Wait for the user to respond to the prompt
            const { outcome } = await deferredPrompt.userChoice;
            console.log(`User response to the install prompt: ${outcome}`);
            // Clear the deferredPrompt variable
            deferredPrompt = null;
            // Hide the install button
            installButton.style.display = 'none';
            installButton.classList.add('hidden');
        }
    });
}

// Listen for successful installation
window.addEventListener('appinstalled', (e) => {
    console.log('PWA was installed successfully');
    if (installButton) {
        installButton.style.display = 'none';
        installButton.classList.add('hidden');
    }
});

// Execute when DOM is loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', registerServiceWorker);
} else {
    registerServiceWorker();
}