import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Tentukan warna pink yang sesuai dengan logo Gen-Z Psychology kamu
                // Kamu bisa gunakan hex code yang lebih spesifik jika ada
                primary: "#FF69B4", // Hot Pink, bisa disesuaikan
                secondary: "#FFC0CB", // Light Pink
                accent: "#6A5ACD", // Slate Blue, untuk kontras jika dibutuhkan
            },
        },
    },

    plugins: [forms],
};
