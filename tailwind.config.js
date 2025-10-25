import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
//export default {
module.exports = {
	content: [
		"./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
		"./storage/framework/views/*.php",
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./resources/**/*.vue",
	],
	safelist: [
		{
			pattern: /animate__/,
		},
	],
	theme: {
		extend: {
			fontFamily: {
				sans: ["Figtree", ...defaultTheme.fontFamily.sans],
			},
			// 👇 Aquí agregamos la animación personalizada
			keyframes: {
				wave: {
					"0%": { transform: "translateX(0)" },
					"100%": { transform: "translateX(-50%)" },
				},
			},
			animation: {
				wave: "wave 12s linear infinite",
			},
		},
	},

	plugins: [forms],
};
