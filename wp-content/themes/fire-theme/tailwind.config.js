// Default Config: https://github.com/tailwindcss/tailwindcss/blob/master/stubs/defaultConfig.stub.js

module.exports = {
  important: false,
  purge: {
    content: ['./templates/**/*.php', './templates/**/*.js', './theme/assets/**/*.js', './theme/main.js', './*.php', './inc/**/*.php', './tailwind-safelist.txt'],
  },
  theme: {
    screens: {
      sm: '575px',
      md: '768px',
      lg: '992px',
      xl: '1200px',
    },
    colors: {
      transparent: 'transparent',
      black: '#000',
      white: '#fff',
      gray: {
        100: '#F5F5F5',
        200: '#E7E7E7',
        300: '#D8D8D8',
        400: '#BBBBBB',
        500: '#9E9E9E',
        600: '#8E8E8E',
        700: '#5F5F5F',
        800: '#474747',
        900: '#2F2F2F',
      }
    },
    container: {
      center: true,
      padding: '1rem',
    },
    fontFamily: {
      body: ['Open Sans', 'Arial', 'sans-serif'],
    },
    fontWeight: {
      light: '300',
      normal: '400',
      medium: '500',
      bold: '700',
    },
    fontSize: {
      12: ['0.75rem', '1rem'],
      14: ['0.875rem', '1rem'],
      16: ['1rem', '1.25rem'],
      18: ['1.125rem', '1.5rem'],
      20: ['1.25rem', '1.5rem'],
      24: ['1.5rem', '1.75rem'],
      26: ['1.625rem', '1.75rem'],
      28: ['1.75rem', '2.125rem'],
      34: ['2.125rem', '2.5rem'],
    },
    extend: {
      spacing: {
        'gap-0': '0',
        'gap-xs': '1.25rem',
        'gap-sm': '2rem',
        'gap-md': '3rem',
        'gap-lg': '5rem',
        'gap-xl': '8rem',
      },
    },
  },
  corePlugins: {},
  plugins: [],
};
