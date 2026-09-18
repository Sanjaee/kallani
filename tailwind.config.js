/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/**/*.php",
    "./public/**/*.html",
  ],
  theme: {
    extend: {
      colors: {
        'kallani-bg': '#F7F7F4',
        'kallani-surface': '#FFFFFF',
        'kallani-text': '#171717',
        'kallani-text-secondary': '#6B6B6B',
        'kallani-border': '#E5E5E5',
        'kallani-muted': '#F0F0EC',
        'kallani-dark': '#171717',
        'kallani-accent': '#2D5016',
        'kallani-green': '#059669',
        'kallani-amber': '#D97706',
        'kallani-red': '#DC2626',
      },
      fontFamily: {
        'inter': ['Inter', 'sans-serif'],
        'geist': ['Geist', 'sans-serif'],
      },
      spacing: {
        '128': '32rem',
      }
    },
  },
  plugins: [],
}
