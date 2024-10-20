import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        colors: {
            background: '#21232D',
            'background-dim': '#272a33e6',
            gray0: '#ffffff',
            gray10: '#eceef2',
            gray20: '#d7dbe4',
            gray30: '#a9b2c2',
            gray40: '#6c7a93',
            gray50: '#4d566b',
            gray60: '#3a4257',
            gray70: '#2e323b',
            gray80: '#282b34',
            gray90: '#15171a',
            blue0: '#f8faff',
            blue00: '#f1f5ff',
            blue10: '#c4d6ff',
            blue20: '#99b7ff',
            blue30: '#6d99ff',
            blue40: '#5182f4',
            blue50: '#3465d7',
            blue60: '#1448c1',
            systemgreen: '#51b638',
            systemred: '#ff4949',
            systemorange: '#f86a1a'
        },
        extend: {
            fontFamily: {
                sans: ['FixelText', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
