// Browser detection utilities
function getBrowserInfo() {
    const userAgent = navigator.userAgent;
    const isChrome = /Chrome/.test(userAgent) && /Google Inc/.test(navigator.vendor);
    const isFirefox = /Firefox/.test(userAgent);
    const isSafari = /Safari/.test(userAgent) && !/Chrome/.test(userAgent);
    const isIOS = /iPad|iPhone|iPod/.test(userAgent);
    const isAndroid = /Android/.test(userAgent);
    
    return {
        isChrome,
        isFirefox,
        isSafari,
        isIOS,
        isAndroid,
        canInstallPWA: (isChrome || isFirefox || (isSafari && isIOS))
    };
}

// Register service worker only in secure contexts
function registerServiceWorker() {
    const browserInfo = getBrowserInfo();
    
    if ('serviceWorker' in navigator) {
        // Check if we're in a secure context (HTTPS or localhost)
        if (location.protocol === 'https:' || location.hostname === 'localhost' || location.hostname === '127.0.0.1') {
            console.log('Registering service worker...', browserInfo);
            
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
                
                // Browser-specific handling
                if (browserInfo.isFirefox) {
                    console.log('Firefox detected - PWA support available');
                } else if (browserInfo.isSafari) {
                    console.log('Safari detected - PWA support with limitations');
                }
                
                // Check for updates
                registration.addEventListener('updatefound', () => {
                    const newWorker = registration.installing;
                    newWorker.addEventListener('statechange', () => {
                        if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                            console.log('New content is available; please refresh.');
                            // Show update notification
                            showUpdateNotification();
                        }
                    });
                });
            })
            .catch(function(err) {
                console.error('ServiceWorker registration failed: ', err);
                
                // Browser-specific error handling
                if (browserInfo.isFirefox) {
                    console.log('Firefox SW registration failed - check manifest validity');
                } else if (browserInfo.isSafari) {
                    console.log('Safari SW registration failed - check HTTPS and manifest');
                }
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

// Show update notification
function showUpdateNotification() {
    const notification = document.createElement('div');
    notification.innerHTML = `
        <div class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            <p class="text-sm">Nouvelle version disponible!</p>
            <button onclick="window.location.reload()" class="bg-white text-blue-600 px-3 py-1 rounded mt-2 text-xs">
                Actualiser
            </button>
        </div>
    `;
    document.body.appendChild(notification);
    
    // Auto-remove after 10 seconds
    setTimeout(() => {
        notification.remove();
    }, 10000);
}

// Enhanced install button management for different browsers
function setupInstallButton(browserInfo) {
    if (!installButton) return;
    
    if (browserInfo.isSafari && browserInfo.isIOS) {
        // Safari iOS - Manual installation instructions
        installButton.innerHTML = `
            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8l-8-8-8 8"></path>
            </svg>
            Installer l'app
        `;
        installButton.addEventListener('click', () => {
            showSafariInstallInstructions();
        });
        installButton.style.display = 'block';
        installButton.classList.remove('hidden');
    } else if (browserInfo.isFirefox) {
        // Firefox - Automatic installation when possible
        installButton.innerHTML = `
            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8l-8-8-8 8"></path>
            </svg>
            Installer l'app
        `;
        installButton.addEventListener('click', () => {
            // Try to trigger automatic installation for Firefox
            if ('serviceWorker' in navigator && 'BeforeInstallPromptEvent' in window) {
                // Firefox might support automatic installation in newer versions
                window.location.reload();
            } else {
                // Fallback: Show brief hint
                const hint = document.createElement('div');
                hint.innerHTML = `
                    <div class="fixed top-20 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 text-sm">
                        Recherchez l'icône ⊕ dans la barre d'adresse
                    </div>
                `;
                document.body.appendChild(hint);
                setTimeout(() => hint.remove(), 3000);
            }
        });
        installButton.style.display = 'block';
        installButton.classList.remove('hidden');
    } else if (browserInfo.isChrome) {
        // Chrome - Wait for beforeinstallprompt or show after delay
        setTimeout(() => {
            if (!deferredPrompt && installButton) {
                installButton.style.display = 'block';
                installButton.classList.remove('hidden');
                installButton.addEventListener('click', () => {
                    // Fallback hint for Chrome without prompt
                    const hint = document.createElement('div');
                    hint.innerHTML = `
                        <div class="fixed top-20 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 text-sm">
                            App déjà installée ou non compatible
                        </div>
                    `;
                    document.body.appendChild(hint);
                    setTimeout(() => hint.remove(), 3000);
                });
            }
        }, 3000);
    }
}

// Safari iOS installation instructions
function showSafariInstallInstructions() {
    const modal = document.createElement('div');
    modal.innerHTML = `
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg p-6 max-w-md w-full">
                <h3 class="text-lg font-semibold mb-4">Installer UniPulse</h3>
                <div class="space-y-3 text-sm">
                    <p class="flex items-center">
                        <span class="inline-block w-6 h-6 bg-blue-100 text-blue-600 rounded-full text-center text-xs leading-6 mr-3">1</span>
                        Appuyez sur le bouton de partage <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2L13 5H11V10H9V5H7L10 2Z"></path><path d="M4 11V17H16V11H18V17C18 18.1 17.1 19 16 19H4C2.9 19 2 18.1 2 17V11H4Z"></path></svg>
                    </p>
                    <p class="flex items-center">
                        <span class="inline-block w-6 h-6 bg-blue-100 text-blue-600 rounded-full text-center text-xs leading-6 mr-3">2</span>
                        Sélectionnez "Sur l'écran d'accueil"
                    </p>
                    <p class="flex items-center">
                        <span class="inline-block w-6 h-6 bg-blue-100 text-blue-600 rounded-full text-center text-xs leading-6 mr-3">3</span>
                        Appuyez sur "Ajouter"
                    </p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="mt-4 w-full bg-indigo-600 text-white py-2 rounded-lg">
                    Compris!
                </button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
}

// Listen for the beforeinstallprompt event (Chrome/Edge)
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

// Handle install button click (Chrome/Edge)
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
    document.addEventListener('DOMContentLoaded', () => {
        const browserInfo = getBrowserInfo();
        registerServiceWorker();
        setupInstallButton(browserInfo);
    });
} else {
    const browserInfo = getBrowserInfo();
    registerServiceWorker();
    setupInstallButton(browserInfo);
}