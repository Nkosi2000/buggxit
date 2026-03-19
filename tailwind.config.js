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
            screens: {
                'sm': '640px',
                'md': '768px',
                'tablet': '777px', // Custom breakpoint for your specific screen size
                'lg': '1024px',
                'xl': '1280px',
                '2xl': '1536px',
            },
            animation: {
                'slide-down': 'slideDown 0.3s ease-out',
                'slide-up': 'slideUp 0.2s ease-in',
                'fade-in': 'fadeIn 0.2s ease-out',
                'fade-out': 'fadeOut 0.15s ease-in',
            },
            keyframes: {
                slideDown: {
                    '0%': { opacity: '0', transform: 'translateY(-10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideUp: {
                    '0%': { opacity: '1', transform: 'translateY(0)' },
                    '100%': { opacity: '0', transform: 'translateY(-10px)' },
                },
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeOut: {
                    '0%': { opacity: '1' },
                    '100%': { opacity: '0' },
                },
            },
        },
    },

    plugins: [forms],
};