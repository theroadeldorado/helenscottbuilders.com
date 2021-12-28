const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
  plugins: {
    'postcss-import': {},
    'tailwindcss/nesting': {},
    tailwindcss: {},
    autoprefixer: {},
    'postcss-preset-env': {
      stage: 1,
      features: {
        'focus-within-pseudo-class': false,
      },
    },
    cssnano: isProduction ? { preset: 'default' } : false,
  },
};
