const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            height: theme => ({
                "screen/2": "50vh",
                "screen/3": "calc(100vh / 3)",
                "screen/4": "calc(100vh / 4)",
                "screen/5": "calc(100vh / 5)",
                "screen-nav": "calc(100vh - 64px)",
                "screen-mobile": "calc(100vh - 112px)",
            }),
        },
    },

    variants: {
        mixBlendMode: ['responsive'],
        backgroundBlendMode: ['responsive'],
        isolation: ['responsive'],
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwindcss-tables')(),
        require('tailwindcss-blend-mode')(),
    ],
};
