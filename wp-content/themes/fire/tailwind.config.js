// Default Config: https://github.com/tailwindcss/tailwindcss/blob/master/stubs/defaultConfig.stub.js

module.exports = {
  content: ['./templates/**/*.php', './templates/**/*.js', './theme/assets/**/*.js', './theme/main.js', './*.php', './inc/**/*.php', './theme/assets/**/*.svg'],
  safelist: [
    {
      pattern: /(mt|mb)-gap-(0|xs|sm|md|lg|xl)/,
      variants: ['lg', 'md'],
    },
  ],
  important: false,
  theme: {
    screens: {
      sm: '575px',
      md: '768px',
      lg: '992px',
      xl: '1200px',
    },
    container: {
      center: true,
      padding: '1rem',
    },
    fontFamily: {
      body: ['Inter', 'sans-serif'],
    },
    extend: {
      spacing: {
        'gap-0': '0',
        'gap-xs': '1.25rem',
        'gap-sm': '4rem',
        'gap-md': '6rem',
        'gap-lg': '8rem',
        'gap-xl': '10rem',
      },
    },
  },
  plugins: [require('@tailwindcss/line-clamp'), require('@tailwindcss/aspect-ratio')],
};
