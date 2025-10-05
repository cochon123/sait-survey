import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Register service worker with PWA functionality
import './registerSW.js';
