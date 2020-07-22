const { colors, boxShadow } = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.vue',
      './resources/**/*.sass',
      './src/**/*.js',
  ],
  theme: {
    extend: {
        colors: {
            ...colors,
            orange: {
                '400': '#fbb560',
                '500': '#f1890d',
                '600': '#e26600',
            },
        },
        boxShadow: {
            ...boxShadow,
            'outline-gray': '0 0 0 2px rgba(0, 0, 0, 0.05)',
        }
    },
  },
  variants: {},
  plugins: [],
}
