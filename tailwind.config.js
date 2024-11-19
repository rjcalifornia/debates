/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}", "./node_modules/preline/preline.js"], // Ensure this covers all the right files
  theme: {
    extend: {},
  },
  plugins: [
    require('preline/plugin'),
    require('@tailwindcss/forms'),
  ],
}

