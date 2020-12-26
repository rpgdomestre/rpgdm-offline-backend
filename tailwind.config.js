module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false,
    theme: {
      extends: {}
    },
    variants: {
      extend: {
        animation: ['hover'],
      }
    },
    plugins: [require("@tailwindcss/typography")]
  };
