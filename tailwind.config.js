import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Design system colors using CSS variables
                'bg-dark': 'var(--bg-dark)',
                'bg': 'var(--bg)',
                'bg-light': 'var(--bg-light)',
                'text': 'var(--text)',
                'text-muted': 'var(--text-muted)',
                'brand': 'var(--brand)',
                
                // Semantic aliases
                'surface': {
                    'base': 'var(--bg-dark)',
                    'elevated': 'var(--bg)',
                    'high': 'var(--bg-light)',
                },
                'content': {
                    'primary': 'var(--text)',
                    'secondary': 'var(--text-muted)',
                },
                'accent': 'var(--brand)',
            },
            boxShadow: {
                'frosted-s': 'var(--shadow-s)',
                'frosted-m': 'var(--shadow-m)',
                'inset-light': 'var(--shadow-inset-light)',
                'inset-dark': 'var(--shadow-inset-dark)',
            },
            backdropBlur: {
                'frosted': '10px',
                'frosted-light': '8px',
            },
        },
    },

    darkMode: 'class', // Enable class-based dark mode

    plugins: [forms],
};
