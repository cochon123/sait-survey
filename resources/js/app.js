import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Register service worker with PWA functionality
import './registerSW.js';

// Temporary: PWA debugging (remove in production)
if (process.env.NODE_ENV === 'development' || location.hostname !== 'localhost') {
    import('./pwa-debug.js');
}
