const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                roboto: ['Roboto', 'sans-serif']
            },
            colors: {
                'accent-1': '#14980E',
                'accent-2': '#F1F1F1',
                'accent-3': '#4D4D4D',
                'accent-4': '#F4F4F4',
                'accent-5': '#356F11',
                'accent-6': '#5BA82B',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
