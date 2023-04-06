const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            backgroundColor: theme => ({
                ...theme('colors'),
                'ipn': '#75003E',
                'inputField': '#DEDEDE',
            }),
            backgroundImage: {
                'login': "url('/public/img/main.png')",
                // 'main': "url('/public/img/bg-main.png')",
            },
            textColor: {
                'ipn': '#75003E',
            },
            borderColor: {
                'ipn': '#75003E',
                'inputField': '#DEDEDE',
            },
        },
    },

    plugins: [require("@tailwindcss/forms"), require("@tailwindcss/typography")],
};
