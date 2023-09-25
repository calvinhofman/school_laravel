/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    container: {
      center: true,
      screens: {
        default: '400px',
        sm: '600px',
        md: '728px',
        lg: '900px',
        xl: '900px',
        '2xl': '1224px',
      },

    },
    extend: {},
  },
  plugins: [],
}

