/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/car_owner/dashboard.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [
      require('flowbite/plugin')
  ],
}