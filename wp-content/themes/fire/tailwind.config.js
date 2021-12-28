// Default Config: https://github.com/tailwindcss/tailwindcss/blob/master/stubs/defaultConfig.stub.js

module.exports = {
  content: ['./templates/**/*.php', './templates/**/*.js', './theme/assets/**/*.js', './theme/main.js', './*.php', './inc/**/*.php', './tailwind-safelist.txt'],
  important: false,
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
      },
      red: {
        100: '#fff5f5',
        200: '#fed7d7',
        300: '#feb2b2',
        400: '#fc8181',
        500: '#f56565',
        600: '#e53e3e',
        700: '#c53030',
        800: '#9b2c2c',
        900: '#742a2a',
      },
      green: {
        100: '#f0fff4',
        200: '#c6f6d5',
        300: '#9ae6b4',
        400: '#68d391',
        500: '#48bb78',
        600: '#38a169',
        700: '#2f855a',
        800: '#276749',
        900: '#22543d',
      },

      primary: {
        100: '#EBF8F2',
        200: '#CDEDDE',
        300: '#AFE1CA',
        400: '#73CBA3',
        500: '#37B57B',
        600: '#32A36F',
        700: '#216D4A',
        800: '#195137',
        900: '#113625',
      },
      secondary: {
        100: '#F0EFF4',
        200: '#DAD6E3',
        300: '#C3BDD2',
        400: '#968CB0',
        500: '#695B8E',
        600: '#5F5280',
        700: '#3F3755',
        800: '#2F2940',
        900: '#201B2B',
      },
      accent: {
        100: '#F8F4FD',
        200: '#EEE5F9',
        300: '#E3D5F6',
        400: '#CFB5EF',
        500: '#BA95E8',
        600: '#A786D1',
        700: '#70598B',
        800: '#544368',
        900: '#382D46',
      },
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
  plugins: [],
};