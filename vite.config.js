import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { VitePWA } from 'vite-plugin-pwa';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        VitePWA({
            registerType: 'autoUpdate',
            injectRegister: null, // We handle registration manually
            filename: 'sw.js',
            strategies: 'generateSW', // Use generateSW instead of injectManifest
            outDir: 'public', // Generate SW in public root instead of build folder
            manifestFilename: 'manifest.webmanifest', // Generate at root
            workbox: {
                globPatterns: ['**/*.{js,css,html,ico,png,svg,woff2}'],
                globIgnores: ['**/manifest.webmanifest', '**/sw.js', '**/workbox-*.js'],
                navigateFallback: null, // Disable for Laravel routes
                skipWaiting: true,
                clientsClaim: true,
                runtimeCaching: [
                    {
                        urlPattern: /^https:\/\/fonts\.googleapis\.com\/.*/i,
                        handler: 'StaleWhileRevalidate',
                        options: {
                            cacheName: 'google-fonts-stylesheets'
                        }
                    },
                    {
                        urlPattern: /^https:\/\/fonts\.gstatic\.com\/.*/i,
                        handler: 'CacheFirst',
                        options: {
                            cacheName: 'google-fonts-webfonts',
                            expiration: {
                                maxEntries: 10,
                                maxAgeSeconds: 60 * 60 * 24 * 365 // 365 days
                            },
                            cacheableResponse: {
                                statuses: [0, 200]
                            }
                        }
                    }
                ]
            },
            manifest: {
                name: 'UniPulse - SAIT Student Survey',
                short_name: 'UniPulse',
                description: 'Plateforme de sondage pour améliorer la vie étudiante à SAIT',
                theme_color: '#6366f1',
                start_url: '/',
                scope: '/',
                display: 'standalone',
                display_override: ['window-controls-overlay', 'standalone', 'minimal-ui'],
                background_color: '#ffffff',
                orientation: 'portrait',
                categories: ['education', 'social'],
                lang: 'fr',
                icons: [
                    {
                        src: '/images/icons/icon-72x72.png',
                        sizes: '72x72',
                        type: 'image/png',
                        purpose: 'any'
                    },
                    {
                        src: '/images/icons/icon-96x96.png',
                        sizes: '96x96',
                        type: 'image/png',
                        purpose: 'any'
                    },
                    {
                        src: '/images/icons/icon-128x128.png',
                        sizes: '128x128',
                        type: 'image/png',
                        purpose: 'any'
                    },
                    {
                        src: '/images/icons/icon-144x144.png',
                        sizes: '144x144',
                        type: 'image/png',
                        purpose: 'any'
                    },
                    {
                        src: '/images/icons/icon-152x152.png',
                        sizes: '152x152',
                        type: 'image/png',
                        purpose: 'any'
                    },
                    {
                        src: '/images/icons/icon-180x180.png',
                        sizes: '180x180',
                        type: 'image/png',
                        purpose: 'any'
                    },
                    {
                        src: '/images/icons/icon-192x192.png',
                        sizes: '192x192',
                        type: 'image/png',
                        purpose: 'any maskable'
                    },
                    {
                        src: '/images/icons/icon-384x384.png',
                        sizes: '384x384',
                        type: 'image/png',
                        purpose: 'any'
                    },
                    {
                        src: '/images/icons/icon-512x512.png',
                        sizes: '512x512',
                        type: 'image/png',
                        purpose: 'any maskable'
                    }
                ],
                shortcuts: [
                    {
                        name: 'Nouvelles propositions',
                        short_name: 'Nouveau',
                        description: 'Voir les dernières propositions',
                        url: '/propositions',
                        icons: [{ src: '/images/icons/icon-192x192.png', sizes: '192x192' }]
                    }
                ],
                prefer_related_applications: false,
                related_applications: []
            },
            devOptions: {
                enabled: true, // Enable in development
                type: 'module'
            }
        }),
    ],
});
