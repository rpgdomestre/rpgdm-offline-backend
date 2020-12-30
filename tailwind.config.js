module.exports = {
    purge: {
      content: [
        './resources/**/*.blade.php',
        './content/**/*.blade.md',
      ],
      options: {
      }
    },
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
