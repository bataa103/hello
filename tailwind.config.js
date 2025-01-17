/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        colors: {
          'custom-navy': '#1E3456',
          'gold': '#FFD700',
        },
        animation: {
          fall: 'fall 5s linear infinite',
        },
        keyframes: {
          fall: {
            '0%': { transform: 'translateY(0) rotate(0deg)', opacity: '1' },
            '100%': { transform: 'translateY(100vh) rotate(360deg)', opacity: '0' },
          },
        },
      },
    },
    plugins: [],
  };
