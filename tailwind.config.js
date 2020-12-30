module.exports = {
    purge: {
      content: [
        './resources/**/*.blade.php',
        './content/**/*.blade.md',
        './public/**/*.html',
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
