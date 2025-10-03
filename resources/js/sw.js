self.addEventListener('install', function(event) {
    console.log('Service Worker installing.');
});

self.addEventListener('fetch', function(event) {
    console.log('Service Worker fetching:', event.request.url);
});

// This is required for the PWA manifest injection
self.__WB_MANIFEST;