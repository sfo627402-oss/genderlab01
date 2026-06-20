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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                outfit: ['Outfit', 'sans-serif'],
            },
            colors: {
                bio: {
                    50: '#eefcff',
                    100: '#d6f2ff',
                    200: '#a8e5ff',
                    300: '#72d2ff',
                    400: '#38b4ff',
                    500: '#0d88ff',
                    600: '#006cdc',
                    700: '#0051a6',
                    800: '#00396f',
                    900: '#022c4f',
                },
                brand: {
                    50: '#effcfa',
                    100: '#d7f7f0',
                    200: '#a9eee0',
                    300: '#5fe4c0',
                    400: '#2bd79f',
                    500: '#10c16f',
                    600: '#0c9e55',
                    700: '#0b7a3e',
                    800: '#095a2e',
                    900: '#07441f',
                },
                logo: {
                    blue: '#0084ff',
                    green: '#4de12f',
                    cyan: '#22d3ee',
                },
            },
        },
    },

    plugins: [forms],
};
