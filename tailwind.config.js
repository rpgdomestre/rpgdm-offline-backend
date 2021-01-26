const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  purge: [
    './vendor/laravel/jetstream/**/*.blade.php',
    './storage/framework/views/*.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './content/**/*.blade.md',
    './public/**/*.html',
  ],

  theme: {
    extend: {},
  },

  variants: {
    extend: {
      animation: ['hover'],
      opacity: ['disabled'],
    },
  },

  plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
