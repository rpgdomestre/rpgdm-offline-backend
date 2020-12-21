module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php'
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
