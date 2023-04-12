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
                'ipn-dark': '#400022',
                'inputField': '#DEDEDE',
                // Table headers
                'ipn-1': '#690038',
                'ipn-2': '#5F0032',
                'ipn-3': '#52002B',
                'ipn-4': '#3C0020',
                'ipn-5': '#250014',
            }),
            backgroundImage: {
                'login': "url('/public/img/main.png')",
                'loginV': "url('/public/img/mainV.png')",
                'testing': "url('/public/img/mainVer.png')",
            },
            textColor: {
                'ipn': '#75003E',
                'ipn-dark': '#400022',
                'ipn-gray': '#414040',
            },
            borderColor: {
                'ipn': '#75003E',
                'ipn-dark': '#400022',
                'inputField': '#DEDEDE',
            },
        },
    },

    plugins: [require("@tailwindcss/forms"), require("@tailwindcss/typography")],
};
