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
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    DEFAULT: '#2554C7',
                    dark: '#1C43A3',
                    muted: '#DCE6F7',
                    soft: '#EAF0FB',
                },
                ink: {
                    DEFAULT: '#101828',
                    body: '#475467',
                    muted: '#667085',
                    faint: '#8A93A3',
                },
                line: {
                    DEFAULT: '#EEF1F5',
                    strong: '#E4E7EC',
                },
                canvas: '#FAFBFC',
                panel: '#F7F9FC',
                ok: '#12B76A',
                danger: '#F04438',
            },
        },
    },

    plugins: [forms],
};
